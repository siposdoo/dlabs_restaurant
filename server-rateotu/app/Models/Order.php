<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Order extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'table_id',
        'total'
    ];

    public function order_items()
    {
        return $this->hasMany('App\Models\OrderItems');
    }
    public function order_table()
    {
        return $this->hasOne('App\Models\Table', 'id', 'table_id');
    }
}
