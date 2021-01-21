<?php

namespace App\Repositories;

use App\Helpers\Interfaces\Standards;
use App\Models\Parcel;
use App\Models\ParcelDetail;
use App\Models\Standard;
use App\Helpers\Traits\LogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParcelDetailRepository extends Model
{
    use LogTrait;

    /**
     * The model being queried.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    
    /**
     * ParcelDetailRepository constructor.
     * @param Parcel $parcel
     */
    public function __construct(ParcelDetail $parcelDetail)
    {
        $this->model = $parcelDetail;
    }

    /**
     * @param array $data
     * @param Parcel $parcel
     * @param Standard $standard
     * @return Parcel
     */
    public function createSingle($parcel, $standard, $data)
    {
        // Find which model to use to compute the total price for each case
        $class = 'App\\Helpers\\Interfaces\\' . ucfirst($standard->model);
        /** @var Standards $standards */
        $standards = new $class($standard->unit, $data['value']);

        $parcel =  $this->model->create([
            'parcel_id' => $parcel->id,
            'standard_id' => $standard->id,
            'standard_unit' => $standard->unit,
            'value' => $data['value'],
            'price' => $standards->calculate(),
        ]);

        return $parcel;
    }

    /**
     * Check which one is the optimal (maximum) pricing model for each case
     *
     * @param int $parcelId
     * @return ParcelDetail
     */
    public function getOptimalRecord($parcelId)
    {
        return $this->model
            ->where('parcel_id', $parcelId)
            ->orderByDesc('price')
            ->first();
    }

    /**
     * Save by setting the is_optimal to true
     *
     * @param ParcelDetail $parcelDetail
     */
    public function saveAsOptimal($parcelDetail)
    {
        $parcelDetail->is_optimal_value = 1;
        $parcelDetail->save();
    }
}