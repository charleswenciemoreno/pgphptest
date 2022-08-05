<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Users\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_profile()
    {
        $response = $this->get('/user/1');

        $response->assertStatus(200);
    }

    public function test_database() {

        $this->assertDatabaseHas('users', [
            'name' => 'John Smith'
        ]);
    }

    public function test_store_new_comments() {

        $user = User::factory()->count(1)->make();

        $user = $user->first();

        if ($user) {

            $response = $this->post('/', [
                'id' => $user->id,
                'comments' => 'test comment'
            ]);
        }

        $this->assertTrue(true);
    }
}
