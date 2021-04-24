<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class MembershipController extends Controller
{
    /**
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'team_id' => 'required|exists:teams,id',
        ]);

        $amountOfExistingMemberships = Membership::query()
            ->where('user_id', $validated['user_id'])
            ->where('team_id', $validated['team_id'])
            ->count();
        
        if ($amountOfExistingMemberships > 0){
            throw ValidationException::withMessages([
                "user_id" => "This user is already a member of the team",
                "team_id" => "This team already has the user in it",
            ]);
        }

        $membership = new Membership();
        $membership->fill($validated);
        $membership->save();

        return $membership;
    }

    /**
     * @param  Membership  $membership
     * @return Response
     */
    public function destroy(Membership $membership)
    {
        return $membership->delete();
    }
}
