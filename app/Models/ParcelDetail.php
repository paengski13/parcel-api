<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parcel_id', 'standard_id', 'value', 'price', 'is_optimal_value'];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }
}
