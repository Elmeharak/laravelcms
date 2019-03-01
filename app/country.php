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
        'gov'
    ];
    public function governorate() {
        return $this->hasMany('App\governorate');
    }
}
