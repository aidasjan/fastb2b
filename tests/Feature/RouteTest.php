<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteTest extends TestCase
{
    public function testMainRoutes()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->post('/login');
        $response->assertStatus(302);

        $response = $this->get('/dashboard');
        $response->assertStatus(302);

        $response = $this->get('/users');
        $response->assertStatus(302);

        $response = $this->get('/dashboard');
        $response->assertStatus(302);

        $response = $this->post('/products');
        $response->assertStatus(302);
    }

    public function testDiscountRoute()
    {
        $response = $this->post('discounts', []);
        $response->assertStatus(302);
    }

    public function testProductRoute()
    {
        $response = $this->post('products', []);
        $response->assertStatus(302);
    }

    public function testProductFilesRoute()
    {
        $response = $this->post('product_files', []);
        $response->assertStatus(302);
    }
}
