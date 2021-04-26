<?php

namespace Tests\CRUD\Membership;

use App\Models\Membership;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_membership_can_be_made_for_a_user()
    {
        $users = User::factory(1)->create();
        $teams = Team::factory(1)->create();

        $this->post('/api/membership', [
            "user_id" => $users[0]->id,
            "team_id" => $teams[0]->id,
        ])->assertStatus(201);

        $this->get('/api/team/' . $teams[0]->id)->assertJsonFragment(["name" => $users[0]->name]);
    }

    public function test_if_membership_can_not_me_made_with_wrong_user_id()
    {
        $teams = Team::factory(1)->create();

        $this->post('/api/membership', [
            "user_id" => "999",
            "team_id" => $teams[0]->id,
        ])->assertStatus(302);
    }

    public function test_if_membership_can_not_me_made_with_wrong_team_id()
    {
        $users = User::factory(1)->create();

        $this->post('/api/membership', [
            "user_id" => $users[0]->id,
            "team_id" => "999",
        ])->assertStatus(302);
    }

    public function test_if_membership_can_not_be_created_twice()
    {
        $users = User::factory(1)->create();
        $teams = Team::factory(1)->create();

        $membership = new Membership();
        $membership->user_id = User::first()->id;
        $membership->team_id = Team::first()->id;
        $membership->save();

        $this->post('/api/membership', [
            "user_id" => $users[0]->id,
            "team_id" => $teams[0]->id,
        ])->assertStatus(302);
    }
}
