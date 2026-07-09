<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::inertia('/', 'Landing_Page', ['user' => 'Kyzer Chum']);
Route::inertia('/about', 'About');

Route::get('/data', [DataController::class, 'index']);
Route::get('/data/view', [DataController::class, 'show']);

Route::post('/data', [DataController::class, 'store']);
