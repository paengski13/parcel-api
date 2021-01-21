<?php

namespace App\Repositories;

use App\Helpers\Traits\LogTrait;
use App\Models\Parcel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ParcelRepository extends Model
{
    use LogTrait;

    /**
     * The model being queried.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    protected $parcelDetailRepository;

    protected $standardRepository;
    
    /**
     * ParcelRepository constructor.
     * @param Parcel $parcel
     * @param ParcelDetailRepository $parcelDetailRepository
     * @param StandardRepository $standardRepository
     */
    public function __construct(Parcel $parcel, ParcelDetailRepository $parcelDetailRepository,
                                StandardRepository $standardRepository)
    {
        $this->model = $parcel;
        $this->parcelDetailRepository = $parcelDetailRepository;
        $this->standardRepository = $standardRepository;
    }

    /**
     * @param array $data
     * @return Parcel
     */
    public function createSingle($data)
    {
        $parcel =  $this->model->create([
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'description' => $data['description'],
            'quote' => '1.23', // TODO: compute this based on class using interface
        ]);

        foreach ($data['standards'] as $record) {
            $standard = $this->standardRepository->search($record)->first();
            $this->parcelDetailRepository->createSingle($parcel, $standard, $record);
        }

        $parcelDetail = $this->parcelDetailRepository->getOptimalRecord($parcel->id);
        $this->parcelDetailRepository->saveAsOptimal($parcelDetail);
        $parcel->quote = $parcelDetail->price;
        $parcel->save();

        if ($parcel) {
            $this->saveLog("Parcel was successfully created");
        }
        return $parcel;
    }

    /**
     * @param int $id
     * @return Parcel
     */
    public function getSingle($id)
    {
        return $this->model->where('id', $id)
            ->where('user_id', Auth::id())->first();
    }

    /**
     * Update only the basic parcel info
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateSingle($id, $data)
    {
        $parcel = $this->model->where('id', $id)
            ->where('user_id', Auth::id())->first();

        if ($parcel) {
            $parcel->update($data);
            $this->saveLog("Parcel was successfully updated");
        }

        return $parcel;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteSingle($id)
    {
        $parcel = $this->model->where('id', $id)
            ->where('user_id', Auth::id())->first();
        if (!$parcel) {
            return false;
        }
        $parcel->delete();
        return true;
    }

    /**
     * @param array $parcelIds
     * @return bool
     */
    public function getParcels($parcelIds)
    {
        return $this->model->whereIn('id', $parcelIds)
            ->where('user_id', Auth::id());
    }
}