<?php

namespace Tests\CRUD\Team;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_team_can_be_created_with_valid_name()
    {
        $this->post('/api/team', ["name" => "Juventus"])->assertStatus(201);
        $this->get('/api/team')->assertJsonFragment(["name" => "Juventus"]);
    }

    public function test_if_name_can_not_be_long_than_255_chars()
    {
        $this->post('/api/team', ["name" => str_repeat("X", 256)])->assertStatus(302);
    }

    public function test_if_name_is_present_in_request()
    {
        $this->post('/api/team')->assertStatus(302);
    }
}
