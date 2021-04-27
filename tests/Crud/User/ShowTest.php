<?php

namespace Tests\CRUD\User;

use App\Models\Membership;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_user_can_be_created_with_valid_name()
    {
        $users = User::factory(1)->create();
        $this->get('/api/user/' . $users[0]->id)->assertJsonFragment(["name" => $users[0]->name]);
    }

    public function test_if_teams_are_also_shown()
    {
        $teams = Team::factory(1)->create();
        $users = User::factory(1)->create();

        $membership = new Membership();
        $membership->user_id = $users[0]->id;
        $membership->team_id = $teams[0]->id;
        $membership->save();

        $resp = $this->get('/api/user/' . $users[0]->id);
        $resp->assertJsonFragment(["name" => $teams[0]->name]);
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
