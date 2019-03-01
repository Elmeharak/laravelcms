<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    protected $table = 'offers';

    protected $primaryKey = "offer_id";

    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'user_id',
        'country_id',
        'gov_id',

    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id','user_id');
    }

    public function country() {
        return $this->belongsTo('App\country', 'country_id','country_id');
    }

    public function city() {
        return $this->belongsTo('App\governorate', 'gov_id','gov_id');
    }



}
