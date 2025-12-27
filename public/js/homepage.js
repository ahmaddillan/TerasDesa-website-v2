function animateCountUp(id, target, duration) {
    const element = document.getElementById(id);
    if(!element) return;

    let targetNumber = parseInt(target);
    let start = 0;
    let startTime = null;

    function step(currentTime) {
        if (startTime === null) startTime = currentTime;
        const progress = Math.min((currentTime - startTime) / duration, 1);
        let currentNumber = Math.floor(progress * targetNumber);

        // Menggunakan format angka Indonesia (.)
        element.innerText = currentNumber.toLocaleString('id-ID');

        if (progress < 1) {
            window.requestAnimationFrame(step);
        } else {
            element.innerText = target.toLocaleString('id-ID');
        }
    }
    window.requestAnimationFrame(step);
}

document.addEventListener("DOMContentLoaded", function() {
    // Jalankan animasi saat halaman dimuat
    animateCountUp("stat-penduduk", 2456, 2000); 
    animateCountUp("stat-produk", 487, 2000); 
    animateCountUp("stat-pengrajin", 156, 2000); 
    animateCountUp("stat-proyek", 8, 1500); 
});