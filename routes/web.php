<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $kopkenCount = DB::table('kopken_points')->count();
    $foreCount = DB::table('fore_points')->count();
    $kopkenRating = DB::table('kopken_points')->avg('rating');
    $foreRating = DB::table('fore_points')->avg('rating');
    return view('welcome', compact('kopkenCount', 'foreCount', 'kopkenRating', 'foreRating'));
});

Route::get('/map', [MapController::class, 'index'])->name('map');
Route::get('/nearest', [MapController::class, 'nearest']);

Route::get('/about', function () {
    return view('about');
})->name('about');