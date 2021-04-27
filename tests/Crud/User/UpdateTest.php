<?php

namespace Tests\CRUD\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_user_can_be_updated_with_valid_name()
    {
        $users = User::factory(1)->create();
        $this->put('/api/user/' . $users[0]->id, ["name" => "Bader"])->assertStatus(200);
        $user = User::find($users[0]->id);
        $this->assertEquals("Bader", $user->name);
    }

    public function test_if_name_can_not_be_long_than_255_chars()
    {
        $users = User::factory(1)->create();
        $this->put('/api/user/' . $users[0]->id, ["name" => str_repeat("X", 256)])->assertStatus(302);
        $user = User::find($users[0]->id);
        $this->assertEquals($users[0]->name, $user->name);
    }

    public function test_if_name_is_present_in_request()
    {
        $users = User::factory(1)->create();
        $this->put('/api/user/' . $users[0]->id, [])->assertStatus(302);
        $user = User::find($users[0]->id);
        $this->assertEquals($users[0]->name, $user->name);
    }
}
