<?php

namespace Tests\CRUD\Team;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_team_can_be_deleted()
    {
        $teams = Team::factory(1)->create();
        $this->delete("/api/team/" . $teams[0]->id);
        $this->assertEquals(0, Team::count());
    }

    public function test_if_team_returns_404_on_non_found_id()
    {
        $this->delete("/api/team/999")->assertStatus(404);
    }
}
