<div x-data="weatherWidget()" x-init="initWeather()" class="bento-card col-span-1 md:row-span-2 bg-retro-surface border border-retro-border p-6 flex flex-col justify-between relative overflow-hidden group">
    
    {{-- Header --}}
    <div class="z-10">
        <span class="text-xs text-gray-500 uppercase tracking-widest flex items-center gap-2">
            <span x-show="loading" class="animate-spin">↻</span>
            <span x-text="locationName">DETECTING...</span>
        </span>
        
        {{-- Tampilan Suhu Utama --}}
        <div class="mt-4">
            <template x-if="weather">
                <div>
                    <p class="text-4xl font-bold" x-text="Math.round(weather.temperature) + '°C'"></p>
                    <p class="text-sm text-gray-400 mt-1" x-text="getWeatherDesc(weather.weathercode)"></p>
                </div>
            </template>
            <template x-if="!weather && !loading">
                <p class="text-sm text-red-400">Gagal memuat.</p>
            </template>
        </div>

        {{-- Detail Tambahan (UV & Angin) --}}
        <template x-if="details">
            <div class="grid grid-cols-2 gap-2 mt-6 text-xs text-gray-400">
                <div>
                    <span class="block text-gray-600">ANGIN</span>
                    <span class="font-mono text-gray-500" x-text="weather.windspeed + ' km/h'"></span>
                </div>
                <div>
                    <span class="block text-gray-600">UV INDEX</span>
                    <span class="font-mono text-gray-500" x-text="details.uv_index[0] || '-'"></span>
                </div>
                <div>
                    <span class="block text-gray-600">SUNRISE</span>
                    <span class="font-mono text-gray-500" x-text="formatTime(details.sunrise[0])"></span>
                </div>
                <div>
                    <span class="block text-gray-600">SUNSET</span>
                    <span class="font-mono text-gray-500" x-text="formatTime(details.sunset[0])"></span>
                </div>
            </div>
        </template>
    </div>
    <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-tl from-gray-800 to-transparent opacity-20 rounded-full blur-xl transform translate-x-10 translate-y-10"></div>
    <button @click="initWeather()" class="absolute top-4 right-4 text-gray-600 hover:text-gray-500 transition-colors" title="Refresh Location">
        ⟳
    </button>
</div>