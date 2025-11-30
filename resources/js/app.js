import AOS from "aos";
import "aos/dist/aos.css";


// --- LOGIKA SPLASH SCREEN & AOS ---
window.addEventListener("load", () => {
    // ... (Kode splash screen kamu yang lama tetap sama) ...
    const textElement = document.getElementById("splash-text");
    const splash = document.getElementById("splash");
    
    if (!splash || !textElement) {
        AOS.init({ offset: 50, duration: 800, easing: "ease-out-cubic" });
        return; 
    }

    const texts = ["loading assets...", "aligning pixels...", "optimizing vibe...", "let's go."];
    let index = 0;

    const interval = setInterval(() => {
        index++;
        if (index < texts.length) {
            textElement.innerText = texts[index];
        } else {
            clearInterval(interval);
            splash.classList.add("hidden-splash");
            setTimeout(() => {
                splash.style.display = "none";
                AOS.init({ once: false, offset: 50, duration: 800, easing: "ease-out-cubic" });
                setTimeout(() => AOS.refresh(), 100);
            }, 800); 
        }
    }, 400); 
});

document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById('translate-popup');
    const btnTranslate = document.getElementById('btn-translate');
    const btnClose = document.getElementById('btn-close-popup');

    const browserLang = navigator.language || navigator.userLanguage;

    // tampilkan popup jika browser bukan Indonesia
    if (!browserLang.startsWith('id')) {
        setTimeout(() => popup.classList.remove('hidden'), 400);
    }

    // tombol close
    btnClose.addEventListener("click", () => {
        popup.classList.add('hidden');
    });

    // tombol translate
    btnTranslate.addEventListener("click", () => {
        // jalankan Google Translate
        const interval = setInterval(() => {
            const frame = document.querySelector('iframe.goog-te-menu-frame');
            if (!frame) return;

            const innerDoc = frame.contentDocument || frame.contentWindow.document;
            const idButton = innerDoc.querySelector('a[lang="id"]');

            if (idButton) {
                idButton.click();
                clearInterval(interval);
                popup.classList.add('hidden');
            }
        }, 300);
    });
});
