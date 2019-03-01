<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class offerImage extends Model
{
    protected $table = 'offer_images';

protected $fillable=[
    'offer_id',
    'image'
];

}
