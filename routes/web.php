<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Services\SpotifyService;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/project/{id}', function ($id) {
    return view('project-detail', ['id' => $id]);
})->name('project.detail');



/* ==========================================
   ROUTE SPOTIFY (HANYA UNTUK SETUP AWAL)
   ========================================== */
   Route::get('/spotify/login', function () {
    $query = http_build_query([
        'client_id' => config('services.spotify.client_id'),
        'response_type' => 'code',
        'redirect_uri' => config('services.spotify.redirect'),
        'scope' => 'user-read-currently-playing user-read-playback-state', 
    ]);
    return redirect('https://accounts.spotify.com/authorize?' . $query);
});

Route::get('/spotify/callback', function (Request $request) {
    $code = $request->code;

    $response = Http::asForm()->withBasicAuth(
        config('services.spotify.client_id'),
        config('services.spotify.client_secret')
    )->post('https://accounts.spotify.com/api/token', [
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => config('services.spotify.redirect'),
    ]);

    return response()->json([
        'PESAN' => 'COPY REFRESH TOKEN INI DAN MASUKKAN KE FILE .env',
        'refresh_token' => $response->json('refresh_token')
    ]);
});