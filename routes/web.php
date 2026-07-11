<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Vue & Inertia Refresher
Route::inertia('/', 'Demo/Index')->name('demo.index');

Route::inertia('/login', 'Login', ['user' => 'Kyzer Chum']);
Route::inertia('/about', 'About');

Route::get('/data', [DataController::class, 'index']);
Route::get('/data/view', [DataController::class, 'show']);

Route::post('/data', [DataController::class, 'store']);
