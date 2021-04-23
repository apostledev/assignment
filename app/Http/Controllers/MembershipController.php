<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;

class MembershipController extends Controller
{
    /**
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // TODO: create a new membership
    }

    /**
     * @param  Membership  $membership
     * @return Response
     */
    public function destroy(Membership $membership)
    {
        // TODO: remove the membership
    }
}
