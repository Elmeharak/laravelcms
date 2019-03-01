<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
     protected $primaryKey = "cat_id";
    protected $fillable = [
        'cat_name',
        'cat_sub'
    ];
}
