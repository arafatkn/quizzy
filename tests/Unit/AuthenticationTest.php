<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User Login Test.
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::factory()->create([
            'email' => 'testing@unit.com',
            'password' => bcrypt('123456'),
        ]);

        $logged = auth()->attempt(['email' => $user->email, 'password' => '123456']);

        $this->assertTrue($logged);
    }
}
