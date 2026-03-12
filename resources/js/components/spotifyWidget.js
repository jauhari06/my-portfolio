export default () => ({
    song: null,
    loading: true,

    initSpotify() {
        this.fetchData();

        // AUTO REFRESH: Mengecek setiap 30 detik (30000 milidetik)
        setInterval(() => {
            this.fetchData();
        }, 30000);
    },

    async fetchData() {
        this.loading = true;
        try {
            // Memanggil Route API Laravel yang baru kita buat
            const response = await fetch("/api/spotify/now-playing");
            const data = await response.json();

            // Jika data tidak kosong
            if (Object.keys(data).length > 0) {
                this.song = data;
            } else {
                this.song = null;
            }
        } catch (error) {
            console.error("Gagal mengambil data Spotify", error);
            this.song = null;
        }
        this.loading = false;
    },
});
