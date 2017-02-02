<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $table = "sliders";
    protected $fillable = [
        'title','image', 'short_desc', 'active'
    ];
}
