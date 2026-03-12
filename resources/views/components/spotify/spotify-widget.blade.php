<div x-data="spotifyWidget()" x-init="initSpotify()" class="bento-card col-span-1 bg-retro-surface border border-retro-border p-6 flex flex-col justify-between group hover:border-[#1DB954] transition-colors relative overflow-hidden">
    
    <div class="flex items-center gap-2 mb-4 justify-between">
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 rounded-full border border-[#1DB954] flex items-center justify-center text-[#1DB954] text-xs">♫</div>
            <span class="text-xs text-gray-500 uppercase tracking-widest">Now Playing</span>
        </div>
        
        {{-- Tombol Refresh Manual (Opsional, karena sudah ada auto-refresh) --}}
        <button @click="fetchData()" class="text-gray-600 hover:text-[#1DB954] transition-colors" title="Refresh">
            <span x-show="loading" class="animate-spin inline-block">↻</span>
            <span x-show="!loading">⟳</span>
        </button>
    </div>

    {{-- JIKA ADA LAGU --}}
    <template x-if="song">
        <div class="z-10 flex flex-col gap-3">
            <template x-if="song.album_image">
                <img :src="song.album_image" alt="Album Art" class="w-16 h-16 grayscale group-hover:grayscale-0 transition-all duration-500 border border-gray-700 object-cover">
            </template>
            <div class="w-full overflow-hidden">
                <a :href="song.spotify_url" target="_blank" class="font-bold text-lg hover:text-[#1DB954] hover:underline decoration-1 underline-offset-4 leading-tight block truncate" x-text="song.title"></a>
                <p class="text-gray-400 text-sm mt-1 truncate" x-text="song.artist"></p>
            </div>
            
            {{-- Equalizer --}}
            <div class="absolute bottom-4 right-4 flex gap-1 items-end h-4 opacity-50 group-hover:opacity-100">
                <div class="w-1 bg-[#1DB954] animate-[bounce_1s_infinite] h-2"></div>
                <div class="w-1 bg-[#1DB954] animate-[bounce_1.2s_infinite] h-4"></div>
                <div class="w-1 bg-[#1DB954] animate-[bounce_0.8s_infinite] h-3"></div>
            </div>
        </div>
    </template>

    {{-- JIKA TIDAK ADA LAGU --}}
    <template x-if="!song && !loading">
        <div class="z-10 my-auto">
            <p class="text-gray-500 font-mono text-sm">[ SILENCE ]</p>
            <p class="text-xs text-gray-600 mt-2">Not playing anything right now.</p>
        </div>
    </template>
</div>