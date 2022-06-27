<?php

namespace App\Traits;

use App\Models\Item;
use Illuminate\Http\Request;

trait OrderHelper
{
   function getPriceFromItem($id){
       
        return  Item::find($id)->price;
   }
}
