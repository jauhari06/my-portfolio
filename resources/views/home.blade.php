@extends('layouts.app')

@section('content')
<div class="space-y-12">

    <section class="py-10">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight" x-data="{ text: '', fullText: 'HELLO, I AM A DEVELOPER.' }" x-init="
            let i = 0;
            let type = setInterval(() => {
                text += fullText.charAt(i);
                i++;
                if (i > fullText.length) clearInterval(type);
            }, 100);
        ">
            <span x-text="text"></span><span class="animate-pulse">_</span>
        </h1>
        <p class="mt-4 text-gray-400 max-w-xl text-sm md:text-base leading-relaxed">
            Mahasiswa Teknologi Informasi. Fokus pada pengembangan Backend dengan Laravel. 
            Menciptakan solusi digital yang efisien dan estetik.
        </p>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-4 auto-rows-[200px] gap-4">

        <a href="{{ route('project.detail', 1) }}" class="bento-card group col-span-1 md:col-span-2 md:row-span-2 bg-retro-surface border border-retro-border p-6 flex flex-col justify-between hover:border-white transition-colors cursor-pointer relative overflow-hidden">
            <div class="absolute top-2 right-2 text-xs border border-gray-600 px-2 rounded-full">LATEST</div>
            <div class="z-10">
                <h3 class="text-2xl font-bold group-hover:underline decoration-1 underline-offset-4">Sistem Manajemen Tim</h3>
                <p class="text-gray-400 text-sm mt-2">Laravel • PostgreSQL • Notion Integration</p>
            </div>
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-gray-800 opacity-20 transform rotate-45 translate-x-10 translate-y-10"></div>
            <div class="z-10 mt-4 text-xs text-gray-500 group-hover:text-white">Click to view details -></div>
        </a>

        <div class="bento-card bg-retro-surface border border-retro-border p-6 flex flex-col justify-center items-center hover:bg-white hover:text-black transition-colors duration-300">
            <div class="text-4xl mb-2">🐘</div> <span class="font-bold">LARAVEL</span>
        </div>

        <a href="{{ route('project.detail', 2) }}" class="bento-card group bg-retro-surface border border-retro-border p-6 flex flex-col justify-between hover:border-white transition-colors">
            <div>
                <h3 class="text-lg font-bold">Portfolio V1</h3>
                <p class="text-gray-500 text-xs mt-1">HTML • CSS</p>
            </div>
            <div class="text-right text-2xl group-hover:-rotate-45 transition-transform duration-300">↗</div>
        </a>
        
        <a href="#" target="_blank" class="bento-card bg-retro-surface border border-retro-border p-6 flex justify-center items-center gap-2 hover:bg-white hover:text-black transition-colors">
            <span>GITHUB</span>
            <span class="text-xl">↗</span>
        </a>
        
{{-- kode ini untuk API cuaca --}}
        {{-- KARTU CUACA (DYNAMIC LOCATION) --}}
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
                        <p class="text-sm text-red-400">Gagal memuat / Izin lokasi ditolak.</p>
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


        <div class="bento-card col-span-1 md:row-span-2 bg-retro-surface border border-retro-border p-6 flex flex-col justify-between">
            <div>
                <span class="text-xs text-gray-500 uppercase tracking-widest">Location</span>
                <p class="text-xl mt-1 font-bold">Malang,<br>Indonesia</p>
                <p class="text-xs text-gray-400 mt-2 italic">Last month here.</p>
            </div>
            <div class="w-full h-24 bg-gray-800 opacity-50 border border-gray-700 mt-4 flex items-center justify-center text-xs">
                [MAP PLACEHOLDER]
            </div>
        </div>

        <a href="#" target="_blank" class="bento-card bg-retro-surface border border-retro-border p-6 flex justify-center items-center gap-2 hover:bg-white hover:text-black transition-colors">
            <span>GITHUB</span>
            <span class="text-xl">↗</span>
        </a>

        <a href="#" target="_blank" class="bento-card bg-retro-surface border border-retro-border p-6 flex justify-center items-center gap-2 hover:bg-white hover:text-black transition-colors">
            <span>GITHUB</span>
            <span class="text-xl">↗</span>
        </a>

        <div class="bento-card col-span-1 md:col-span-2 bg-white text-black border border-retro-border p-6 flex flex-col justify-center items-start">
            <h3 class="text-xl font-bold mb-2">Contact Me,<br>Let's work together.</h3>
            <a href="mailto:emailmu@gmail.com" class="text-sm underline hover:no-underline">emailmu@gmail.com</a>
        </div>

    </section>
</div>
@endsection

@push('scripts')
<script type="module">
    gsap.from(".bento-card", {
        y: 50,
        opacity: 0,
        duration: 0.8,
        stagger: 0.1,
        ease: "power2.out",
        delay: 0.5 
    });
</script>

<script>
    // {{-- kode ini untuk API cuaca --}}
    document.addEventListener('alpine:init', () => {
        Alpine.data('weatherWidget', () => ({
            loading: true,
            weather: null, // Data cuaca saat ini (current_weather)
            details: null, // Data harian (sunrise, uv, dll)
            locationName: 'DETECTING LOCATION...',

            initWeather() {
                this.loading = true;
                this.locationName = 'LOCATING...';

                // 1. Coba Minta Lokasi User
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            // Sukses dapat lokasi user
                            this.fetchData(position.coords.latitude, position.coords.longitude);
                            this.locationName = 'YOUR LOCATION';
                        },
                        (error) => {
                            // Gagal/Ditolak -> Fallback ke Malang (Default)
                            console.warn('Izin lokasi ditolak, menggunakan default Malang.');
                            this.fetchData(-7.98, 112.63); 
                            this.locationName = 'MALANG (DEFAULT)';
                        }
                    );
                } else {
                    // Browser tidak support -> Default Malang
                    this.fetchData(-7.98, 112.63);
                    this.locationName = 'MALANG (DEFAULT)';
                }
            },

            async fetchData(lat, lon) {
                const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true&daily=sunrise,sunset,uv_index_max&timezone=auto`;

                try {
                    const response = await fetch(url);
                    const data = await response.json();
                    
                    this.weather = data.current_weather;
                    this.details = data.daily;
                    this.loading = false;
                } catch (e) {
                    console.error('Error fetching weather:', e);
                    this.locationName = 'ERROR';
                    this.loading = false;
                }
            },

            // Helper: Ubah kode WMO jadi teks
            getWeatherDesc(code) {
                const codes = {
                    0: 'Cerah ☀️',
                    1: 'Cerah Berawan 🌤',
                    2: 'Berawan ☁️',
                    3: 'Mendung ☁️',
                    45: 'Berkabut 🌫',
                    51: 'Gerimis 🌧',
                    61: 'Hujan Ringan 🌧',
                    63: 'Hujan Sedang 🌧',
                    80: 'Hujan Lebat ⛈',
                    95: 'Badai Petir ⚡'
                };
                return codes[code] || 'Unknown';
            },

            // Helper: Format jam dari format ISO Open-Meteo (2023-12-01T05:00) ke jam saja (05:00)
            formatTime(isoString) {
                if(!isoString) return '-';
                const date = new Date(isoString);
                return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            }
        }));
    });
</script>
@endpush