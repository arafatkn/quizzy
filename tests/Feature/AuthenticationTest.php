<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * Test User Login.
     *
     * @return void
     */
    public function test_registration()
    {
        $response = $this->get('/auth/register');

        $response->assertStatus(200);

        // To Do: Implement POST Request
    }

    /**
     * Test User Login.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->get('/auth/login');

        $response->assertStatus(200);

        // To Do: Implement POST Request
    }
}
