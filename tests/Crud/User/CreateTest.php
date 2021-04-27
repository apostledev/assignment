<?php

namespace Tests\CRUD\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_user_can_be_created_with_valid_name()
    {
        $this->post('/api/user', ["name" => "Kevin"])->assertStatus(201);
        $this->get('/api/user')->assertJsonFragment(["name" => "Kevin"]);
    }

    public function test_if_name_can_not_be_long_than_255_chars()
    {
        $this->post('/api/user', ["name" => str_repeat("X", 256)])->assertStatus(302);
    }

    public function test_if_name_is_present_in_request()
    {
        $this->post('/api/user')->assertStatus(302);
    }
}
