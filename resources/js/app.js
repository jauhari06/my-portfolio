import "./bootstrap";
import Alpine from "alpinejs";
import barba from "@barba/core";
import gsap from "gsap";

window.Alpine = Alpine;
Alpine.start();

barba.init({
    preventRunning: true,
    transitions: [
        {
            name: "opacity-transition",

            // Saat keluar: Halaman lama menghilang perlahan
            leave(data) {
                return gsap.to(data.current.container, {
                    opacity: 0,
                    duration: 0.5,
                });
            },

            // Saat masuk: Halaman baru muncul
            enter(data) {
                // Scroll ke atas otomatis
                window.scrollTo(0, 0);

                return gsap.from(data.next.container, {
                    opacity: 0,
                    duration: 0.5,
                });
            },

            // PENTING: Jika ada animasi spesifik halaman (seperti @push script tadi)
            // Kadang perlu di-trigger ulang disini jika menggunakan logic JS eksternal.
            // Tapi karena kita pakai @push di body, script itu akan tereksekusi otomatis oleh browser
            // saat DOM baru dimasukkan oleh Barba.
        },
    ],
});
