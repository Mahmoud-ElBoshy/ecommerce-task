<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class ProductCreateTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::find(1);
    }

    public function test_product_create_response()
    {
        $response = $this->actingAs($this->user)->postJson('/api/v1/products/product/create',[
            'name' => 'product test one',
            'price' => 70.00,
            'quantity' => 3,
            'category_id' => 1
        ]);
        $response->assertStatus(201);

    }
}
