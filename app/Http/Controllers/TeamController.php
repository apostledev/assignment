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
        return Team::paginate(15);
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
        return Team::with('users')->where('id', $teamId)->get();
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
        Membership::where('team_id', $team->id)->delete();
        return $team->delete();
    }
}
