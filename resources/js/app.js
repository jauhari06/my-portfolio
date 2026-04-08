import "./bootstrap";
import Alpine from "alpinejs";
import barba from "@barba/core";
import gsap from "gsap";
import weatherWidget from "./components/weatherWidget";
import spotifyWidget from "./components/spotifyWidget";

window.Alpine = Alpine;

Alpine.data("spotifyWidget", spotifyWidget);
Alpine.data("weatherWidget", weatherWidget);

Alpine.start();

barba.init({
    preventRunning: true,
    transitions: [
        {
            name: "opacity-transition",

            leave(data) {
                return gsap.to(data.current.container, {
                    opacity: 0,
                    duration: 0.5,
                });
            },

            enter(data) {
                window.scrollTo(0, 0);

                return gsap.from(data.next.container, {
                    opacity: 0,
                    duration: 0.5,
                });
            },
        },
    ],
});
