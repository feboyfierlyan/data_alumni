<?php

use App\Http\Controllers\AlumniController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('alumni.index');
});

Route::resource('alumni', AlumniController::class);
