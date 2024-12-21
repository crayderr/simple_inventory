<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'source_store_id',
        'target_store_id',
        'quantity',
        'timestamp',
        'type',
    ];
}
