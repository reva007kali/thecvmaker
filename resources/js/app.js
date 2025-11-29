document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.getElementById("mobile-menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");
    const menuIcon = menuBtn.querySelector("i");

    // Fungsi Toggle
    menuBtn.addEventListener("click", () => {
        // Toggle class hidden
        mobileMenu.classList.toggle("hidden");

        // Ganti Icon (Menu <-> X)
        const isHidden = mobileMenu.classList.contains("hidden");
        if (!isHidden) {
            // Jika menu terbuka, ganti icon jadi X
            menuIcon.setAttribute("data-feather", "x");
            // Efek background tombol jadi pink biar beda
            menuBtn.classList.remove("bg-neo-blue");
            menuBtn.classList.add("bg-neo-pink");
        } else {
            // Jika menu tertutup, balikin jadi Menu hamburger
            menuIcon.setAttribute("data-feather", "menu");
            // Balikin warna tombol
            menuBtn.classList.remove("bg-neo-pink");
            menuBtn.classList.add("bg-neo-blue");
        }

        // Render ulang feather icon karena atribut berubah
        feather.replace();
    });

    // Opsional: Tutup menu saat link diklik
    mobileMenu.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", () => {
            mobileMenu.classList.add("hidden");
            menuIcon.setAttribute("data-feather", "menu");
            menuBtn.classList.remove("bg-neo-pink");
            menuBtn.classList.add("bg-neo-blue");
            feather.replace();
        });
    });
});
