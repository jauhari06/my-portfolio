<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\SpotifyService;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/spotify/now-playing', function (SpotifyService $spotify) {
    $song = $spotify->getCurrentlyPlaying();
    
    return response()->json($song ?? []);
});
