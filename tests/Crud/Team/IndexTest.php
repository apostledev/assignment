<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_index_shows_team_route()
    {
        $team = Team::factory(1)->create();
        $response = $this->get('/team');
        $response->assertJsonFragment(['name' => $team[0]->name]);
    }

    public function test_if_pagination_works()
    {
        $team = Team::factory(16)->create();
        $response = $this->get('/team');
        $response->assertJsonFragment(['name' => $team[14]->name]);
        $response->assertJsonMissing(['name' => $team[15]->name]);
    }
}
