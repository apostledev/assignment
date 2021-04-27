<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return Team::orderBy('created_at', 'desc')->paginate(15);
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

        $team = new Team();
        $team->fill($validated);
        $team->save();

        return $team;
    }

    /**
     * @param string $teamId
     * @return Response
     */
    public function show(string $teamId)
    {
        return Team::with('memberships', 'memberships.user')->where('id', $teamId)->first();
    }

    /**
     * @param  Request  $request
     * @param  Team  $team
     * @return Response
     */
    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $team->update($validated);

        return $team;
    }

    /**
     * @param  Team  $team
     * @return Response
     */
    public function destroy(Team $team)
    {
        $team->memberships()->delete();
        return $team->delete();
    }
}
