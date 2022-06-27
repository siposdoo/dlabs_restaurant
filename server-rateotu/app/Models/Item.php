<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
 
class Item extends Model
{
    use HasFactory,Uuids;

    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'type'
      
    ];
}
