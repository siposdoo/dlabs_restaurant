<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class OrderItems extends Model
{
    use HasFactory,Uuids;
    protected $fillable = [
        'status',
        'price',
        'quantity',
        'order_id',
        'item_id'
        
    ];

   
}
