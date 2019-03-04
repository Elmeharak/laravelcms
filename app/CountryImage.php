<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryImage extends Model
{
    //
    protected $primaryKey = "image_id";
    protected $table = 'country_images';

    protected $fillable = [
        'country_id',
        'country_image',

    ];

}
