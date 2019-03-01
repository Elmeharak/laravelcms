<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class governorate extends Model
{
    //
    protected $primaryKey = "gov_id";

    protected $fillable =[
        'gov_name',
        'gov_sub',
        'country_id'
    ];
    public function country()
    {
        return $this->belongsTo('App\country');
    }
}
