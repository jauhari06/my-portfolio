export default () => ({
    playlist: null,
    loading: true,

    async initPlaylist() {
        this.loading = true;
        try {
            const response = await fetch("/api/spotify/playlist");
            const data = await response.json();

            // Cek apakah data tidak kosong
            if (Object.keys(data).length > 0) {
                this.playlist = data;
            } else {
                this.playlist = null;
            }
        } catch (error) {
            console.error("Gagal mengambil playlist", error);
            this.playlist = null;
        }
        this.loading = false;
    },
});
