<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'movements';

    protected $fillable = [
        'id',
        'product_id',
        'source_store_id',
        'target_store_id',
        'quantity',
        'timestamp',
        'type',
    ];
}
