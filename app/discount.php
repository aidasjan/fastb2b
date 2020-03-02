<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subcategory;

class Discount extends Model
{
    public function getSubcategory(){
        $discount = $this;
        $subcategory = Subcategory::find($discount->subcategory_id);
        return $subcategory;
    }
}