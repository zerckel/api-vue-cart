<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    protected $fillable = [
        'created_at', 'updated_at', 'quantity', 'product_id',
    ];
}
