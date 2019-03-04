<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    //
    protected $primaryKey = "country_id";

    protected $fillable = [
        'country_name',
        'country_code',
        'gov',
        'image_id'
    ];
    public function governorate() {
        return $this->hasMany('App\governorate');
    }
//    public function image()
//    {
//        return $this->belongsTo('App\CountryImage','image_id','image_id');
//    }
}
