<?php

namespace Tests\CRUD\Membership;

use App\Models\Membership;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_membership_can_be_deleted()
    {
        User::factory(1)->create();
        Team::factory(1)->create();

        $membership = new Membership();
        $membership->user_id = User::first()->id;
        $membership->team_id = Team::first()->id;
        $membership->save();

        $this->delete("/membership/" . $membership->id);

        $this->assertEquals(0, Membership::count());
    }

    public function test_if_membership_returns_404_on_non_found_id()
    {
        $this->delete("/membership/999")->assertStatus(404);
    }
}
