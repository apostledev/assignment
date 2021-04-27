<?php

namespace Tests\CRUD\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_user_can_be_deleted()
    {
        $users = User::factory(1)->create();
        $this->delete("/api/user/" . $users[0]->id);
        $this->assertEquals(0, User::count());
    }

    public function test_if_user_returns_404_on_non_found_id()
    {
        $this->delete("/api/user/999")->assertStatus(404);
    }
}
