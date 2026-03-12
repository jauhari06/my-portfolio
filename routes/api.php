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

Route::get('/spotify/playlist', function (SpotifyService $spotify) {
    // $playlistId = config('services.spotify.playlist_id');
    $playlistId = env('SPOTIFY_PLAYLIST_ID');
    
    $playlist = $spotify->getPlaylist($playlistId);
    
    return response()->json($playlist ?? []);
});