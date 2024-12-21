<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'store_id',
        'quantity',
        'min_quantity',
    ];
}
