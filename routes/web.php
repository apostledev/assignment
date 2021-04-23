<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::resource('/team', TeamController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
