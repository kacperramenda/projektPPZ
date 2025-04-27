<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FunctionalTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_accessible()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    }

    public function test_example_page_is_accessible()
    {
        $response = $this->get('/example');
        $response->assertStatus(200);
    }
}
