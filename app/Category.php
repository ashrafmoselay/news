<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category'; 
    protected $fillable = [
        'parent_id','name', 'active', 'sort'
    ];
    public function parent(){
    	return $this->belongsTo('\App\Category','parent_id','id');
    }
    public function news(){
        return $this->hasMany('\App\News','category_id','id')->orderBy('id','DESC');
    }
    public function newsOrderByViews(){
        return $this->hasMany('\App\News','category_id','id')->orderBy('views','DESC');
    }
    public function childs() { 
        return $this->hasMany('\App\Category', 'parent_id', 'id'); 
    }
}
