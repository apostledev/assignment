<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;

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
        // TODO: save the team
    }

    /**
     * @param  Team  $team
     * @return Response
     */
    public function show(Team $team)
    {
        // TODO: show team with all players
    }

    /**
     * @param  Request  $request
     * @param  Team  $team
     * @return Response
     */
    public function update(Request $request, Team $team)
    {
        // TODO: update team
    }

    /**
     * @param  Team  $team
     * @return Response
     */
    public function destroy(Team $team)
    {
        // TODO: remove team with memberships
    }
}
