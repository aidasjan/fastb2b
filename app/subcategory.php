<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function products(){
        return $this->hasMany('App\Product', 'subcategory_id');
    }
}