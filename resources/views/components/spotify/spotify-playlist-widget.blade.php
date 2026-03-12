<div x-data="spotifyPlaylistWidget()" x-init="initPlaylist()" class="bento-card col-span-1 md:row-span-2 bg-retro-surface border border-retro-border p-6 flex flex-col group hover:border-white transition-colors relative overflow-hidden">
    
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4 border-b border-retro-border pb-3">
        <span class="text-xs text-gray-500 uppercase tracking-widest">Featured Playlist</span>
        <span x-show="loading" class="animate-spin text-gray-500 text-xs">↻</span>
    </div>

    {{-- State Loading --}}
    <template x-if="loading">
        <div class="text-xs text-gray-600 animate-pulse font-mono flex-grow flex items-center justify-center">
            [ LOADING TAPES... ]
        </div>
    </template>

    {{-- State Jika Ada Data --}}
    <template x-if="playlist && !loading">
        <div class="flex flex-col h-full">
            
            {{-- Info Playlist Utama --}}
            <a :href="playlist.url" target="_blank" class="flex items-center gap-3 mb-6 group/link">
                <template x-if="playlist.cover_image">
                    <img :src="playlist.cover_image" alt="Cover" class="w-12 h-12 grayscale group-hover/link:grayscale-0 border border-gray-700 object-cover transition-all">
                </template>
                <div>
                    <h4 class="font-bold text-sm group-hover/link:underline decoration-1 underline-offset-2" x-text="playlist.name"></h4>
                    <p class="text-xs text-gray-500">Curated for Coding</p>
                </div>
            </a>

            {{-- List Lagu (Top 5) --}}
            <div class="flex flex-col gap-4 flex-grow">
                <template x-for="(track, index) in playlist.tracks" :key="index">
                    <a :href="track.url" target="_blank" class="flex items-center justify-between group/track">
                        <div class="overflow-hidden pr-2">
                            <p class="text-sm font-bold text-gray-400 group-hover/track:text-white truncate transition-colors" x-text="track.title"></p>
                            <p class="text-xs text-gray-600 truncate mt-0.5" x-text="track.artist"></p>
                        </div>
                        <span class="text-xs text-gray-700 group-hover/track:text-white transition-colors">↗</span>
                    </a>
                </template>
            </div>

        </div>
    </template>

    {{-- State Jika Error / Kosong --}}
    <template x-if="!playlist && !loading">
        <div class="text-xs text-gray-600 font-mono flex-grow flex items-center justify-center">
            [ PLAYLIST NOT FOUND ]
        </div>
    </template>

</div>