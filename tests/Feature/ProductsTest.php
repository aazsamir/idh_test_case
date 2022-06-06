<?php

namespace Tests\Feature;

use App\Models\Product;

class ProductsTest extends BaseTest
{
    public function testProductsIndex()
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200);
    }

    public function testProductsShow()
    {
        $db = Product::query();
        $db->inRandomOrder();
        $item = $db->first();

        $response = $this->get('/api/products/' . $item->id);

        $response->assertStatus(200);
    }

    public function testProductsStore()
    {
        $post = [
            'name' => 'Product name',
            'description' => 'Product description',
            'price' => 100,
            'currency' => 'USD',
        ];

        $response = $this->post('/api/products', $post, $this->authHeaders());

        $response->assertStatus(201);
    }

    public function testProductsUpdate()
    {
        $db = Product::query();
        $db->inRandomOrder();
        $item = $db->first();

        $post = [
            'name' => 'Product name',
            'description' => 'Product description',
            'price' => 100,
            'currency' => 'USD',
        ];

        $response = $this->put('/api/products/' . $item->id, $post, $this->authHeaders());

        $response->assertStatus(200);
    }

    public function testProductsDelete()
    {
        $db = Product::query();
        $db->inRandomOrder();
        $item = $db->first();

        $response = $this->delete('/api/products/' . $item->id, [], $this->authHeaders());

        $response->assertStatus(204);
    }
}
