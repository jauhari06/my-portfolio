export default () => ({
    loading: true,
    weather: null,
    details: null,
    locationName: "DETECTING LOCATION...",

    initWeather() {
        this.loading = true;
        this.locationName = "LOCATING...";

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    this.fetchData(
                        position.coords.latitude,
                        position.coords.longitude
                    );
                    this.locationName = "YOUR LOCATION";
                },
                (error) => {
                    console.warn(
                        "Izin lokasi ditolak, menggunakan default Malang."
                    );
                    this.fetchData(-7.98, 112.63);
                    this.locationName = "MALANG (DEFAULT)";
                }
            );
        } else {
            this.fetchData(-7.98, 112.63);
            this.locationName = "MALANG (DEFAULT)";
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
            console.error("Error fetching weather:", e);
            this.locationName = "ERROR";
            this.loading = false;
        }
    },

    getWeatherDesc(code) {
        const codes = {
            0: "Cerah ☀️",
            1: "Cerah Berawan 🌤",
            2: "Berawan ☁️",
            3: "Mendung ☁️",
            45: "Berkabut 🌫",
            51: "Gerimis 🌧",
            61: "Hujan Ringan 🌧",
            63: "Hujan Sedang 🌧",
            80: "Hujan Lebat ⛈",
            95: "Badai Petir ⚡",
        };
        return codes[code] || "Unknown";
    },

    formatTime(isoString) {
        if (!isoString) return "-";
        const date = new Date(isoString);
        return date.toLocaleTimeString([], {
            hour: "2-digit",
            minute: "2-digit",
        });
    },
});
