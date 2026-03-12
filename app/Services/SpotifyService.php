<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SpotifyService
{
    // 1. Fungsi untuk menukar Refresh Token
    protected function getAccessToken()
    {
        return Cache::remember('spotify_access_token', 3300, function () {
            $response = Http::asForm()->withBasicAuth(
                config('services.spotify.client_id'),
                config('services.spotify.client_secret')
            )->post('https://accounts.spotify.com/api/token', [ // <--- LINK ASLI SPOTIFY
                'grant_type' => 'refresh_token',
                'refresh_token' => config('services.spotify.refresh_token'),
            ]);

            return $response->json('access_token');
        });
    }

    // 2. Fungsi untuk lagu yang SEDANG diputar
    public function getCurrentlyPlaying()
    {
        $token = $this->getAccessToken();

        if (!$token) return null;

        $response = Http::withToken($token)
            ->get('https://api.spotify.com/v1/me/player/currently-playing'); // <--- LINK ASLI SPOTIFY

        if ($response->status() === 204 || $response->status() !== 200) {
            return null;
        }

        $data = $response->json();

        if (empty($data['is_playing'])) {
            return null; 
        }

        return [
            'title' => $data['item']['name'] ?? 'Unknown',
            'artist' => $data['item']['artists'][0]['name'] ?? 'Unknown Artist',
            'album_image' => $data['item']['album']['images'][0]['url'] ?? null,
            'spotify_url' => $data['item']['external_urls']['spotify'] ?? '#',
        ];
    }

    // 3. Fungsi untuk mengambil Playlist
    public function getPlaylist($playlistId)
    {
        $token = $this->getAccessToken();

        if (!$token) return null;

        $response = Http::withToken($token)
            ->get("https://api.spotify.com/v1/playlists/{$playlistId}");

        $data = $response->json();

        // KUNCI PERBAIKAN: Cari tahu letak array lagunya secara dinamis
        $trackItems = $data['tracks']['items'] ?? $data['items'] ?? null;

        // Cek jika error API atau datanya memang benar-benar kosong
        if ($response->failed() || isset($data['error']) || !$trackItems) {
            return null; 
        }

        // Gunakan variabel $trackItems yang sudah aman
        $tracks = collect($trackItems)
            ->filter(function ($item) {
                // Pastikan lagu/track-nya benar-benar ada
                return !empty($item['track']); 
            })
            ->take(5)
            ->map(function ($item) {
                return [
                    'title' => $item['track']['name'] ?? 'Unknown',
                    'artist' => $item['track']['artists'][0]['name'] ?? 'Unknown Artist',
                    'url' => $item['track']['external_urls']['spotify'] ?? '#',
                ];
            });

        return [
            'name' => $data['name'] ?? 'Playlist',
            'url' => $data['external_urls']['spotify'] ?? '#',
            'cover_image' => $data['images'][0]['url'] ?? null,
            'tracks' => $tracks->toArray(),
        ];
    }
}