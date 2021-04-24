<?php

use App\Http\Controllers\MembershipController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('/team', TeamController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('/user', UserController::class)->only(['index']);
Route::resource('/membership', MembershipController::class)->only(['store', 'destroy']);