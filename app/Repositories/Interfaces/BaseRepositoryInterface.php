<?php

namespace App\Repositories\Interfaces;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryInterface
{
    /**
     * Get paginated items
     */
    public function paginate(int $limit);

    /**
     * Find item by id
     */
    public function find(int $id): BaseModel;

    /**
     * Create item
     */
    public function create(array $data): BaseModel;

    /**
     * Update item
     */
    public function update(int $id, array $data);

    /**
     * Delete item
     */
    public function delete(int $id);
}
