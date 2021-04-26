<?php

namespace Tests\CRUD\Team;

use App\Models\Membership;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_team_can_be_created_with_valid_name()
    {
        $team = $this->post('/api/team', ["name" => "Juventus"])->assertStatus(201);
        $this->get('/api/team/' . $team['id'])->assertJsonFragment(["name" => "Juventus"]);
    }

    public function test_if_members_are_also_shown()
    {
        $teams = Team::factory(1)->create();
        $users = User::factory(1)->create();

        $membership = new Membership();
        $membership->user_id = $users[0]->id;
        $membership->team_id = $teams[0]->id;
        $membership->save();

        $resp = $this->get('/api/team/' . $teams[0]->id);
        $resp->assertJsonFragment(["name" => $users[0]->name]);

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
