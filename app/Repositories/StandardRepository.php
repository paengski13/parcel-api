<?php

namespace App\Repositories;

use App\Models\Parcel;
use App\Models\Standard;
use App\Helpers\Traits\LogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StandardRepository extends Model
{
    use LogTrait;

    /**
     * The model being queried.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    
    /**
     * StandardRepository constructor.
     * @param Standard $standard
     */
    public function __construct(Standard $standard)
    {
        $this->model = $standard;
    }

    /**
     * @param $data array
     * @return Parcel
     */
    public function search($data)
    {
        $query = $this->model;
        if ($data['model']) {
            $query = $query->where('model', $data['model']);
        }
        return $query;
    }
}