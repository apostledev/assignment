<?php

use App\Http\Controllers\MembershipController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('/api/team', TeamController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('/api/user', UserController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('/api/membership', MembershipController::class)->only(['store', 'destroy']);