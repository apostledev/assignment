<?php

namespace Tests\CRUD\Team;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_index_shows_team_route()
    {
        $teams = Team::factory(1)->create();
        $this->get('/team')->assertJsonFragment(['name' => $teams[0]->name]);
    }

    public function test_if_pagination_works()
    {
        $teams = Team::factory(16)->create();
        $this
            ->get('/team')
            ->assertJsonFragment(['name' => $teams[14]->name])
            ->assertJsonMissing(['name' => $teams[15]->name]);
    }
}
