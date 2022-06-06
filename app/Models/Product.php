<?php

namespace App\Models;

use App\Enums\Currency;

class Product extends BaseModel
{
    protected $table = 'product';

    protected $casts = [
        'currency' => Currency::class,
    ];
}
