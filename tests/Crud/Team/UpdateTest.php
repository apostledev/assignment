<?php

namespace Tests\CRUD\Team;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_team_can_be_updated_with_valid_name()
    {
        $team = $this->post('/team', ["name" => "Juventus"])->assertStatus(201);
        $this->put('/team/' . $team['id'], ["name" => "Barca"])->assertStatus(200);
        $team = Team::find($team['id']);
        $this->assertEquals("Barca", $team->name);
    }

    public function test_if_name_can_not_be_long_than_255_chars()
    {
        $team = $this->post('/team', ["name" => "Juventus"])->assertStatus(201);
        $this->put('/team/' . $team['id'], ["name" => str_repeat("X", 256)])->assertStatus(302);
        $team = Team::find($team['id']);
        $this->assertEquals("Juventus", $team->name);
    }

    public function test_if_name_is_present_in_request()
    {
        $team = $this->post('/team', ["name" => "Juventus"])->assertStatus(201);
        $this->put('/team/' . $team['id'])->assertStatus(302);
        $team = Team::find($team['id']);
        $this->assertEquals("Juventus", $team->name);
    }
}
