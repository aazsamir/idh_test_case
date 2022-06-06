<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $simple_columns = [
        'id',
        'name',
        'price',
        'currency',
    ];

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
