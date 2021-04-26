<?php

namespace Tests\CRUD\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_index_shows_team_route()
    {
        $users = User::factory(1)->create();
        $this->get('/api/user')->assertJsonFragment(['name' => $users[0]->name]);
    }

    public function test_if_pagination_works()
    {
        $users = User::factory(16)->create();
        $this
            ->get('/api/user')
            ->assertJsonFragment(['name' => $users[14]->name])
            ->assertJsonMissing(['name' => $users[15]->name]);
    }
}
