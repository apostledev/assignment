<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return User::orderBy('created_at', 'desc')->paginate(15);
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $team = new User();
        $team->fill($validated);
        $team->save();

        return $team;
    }

    /**
     * @param string $userId
     * @return Response
     */
    public function show(string $userId)
    {
        return User::with('memberships', 'memberships.team')->where('id', $userId)->first();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $user->update($validated);

        return $user;
    }

    /**
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $user->memberships()->delete();
        return $user->delete();
    }
}
