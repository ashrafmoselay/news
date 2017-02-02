<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";
    protected $fillable = [
        'category_id','title','image', 'short_desc', 'content','active','show_in_bar'
    ];
    public function category(){
    	return $this->belongsTo('\App\Category','category_id','id');
    }
}
