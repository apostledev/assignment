<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return User::orderBy('created_at', 'desc')->paginate(15);
    }
}
