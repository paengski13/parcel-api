<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'description', 'quote'];

    public function parcelDetails()
    {
        return $this->hasMany(ParcelDetail::class);
    }

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
