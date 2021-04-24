<?php

namespace Tests\CRUD\Team;

use App\Models\Membership;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_team_show_endpoint_shows_the_right_team()
    {
        $teams = Team::factory(2)->create();
        $this->delete('/team/' . $teams[0]['id'])->assertStatus(200);
        $this->get('/team')->assertJsonFragment(["name" => $teams[1]->name]);
        $this->get('/team')->assertJsonMissing(["name" => $teams[0]->name]);
    }

    public function test_if_all_memberships_are_deleted()
    {
        $teams = Team::factory(1)->create();
        $users = User::factory(1)->create();

        $membership = new Membership();
        $membership->user_id = $users[0]->id;
        $membership->team_id = $teams[0]->id;
        $membership->save();

        $this->delete('/team/' . $teams[0]->id)->assertStatus(200);

        $this->assertEquals(0, Membership::count());
    }

    public function test_if_404_on_not_found_id()
    {
        $this->delete('/team/999')->assertStatus(404);
    }
}
