function toggleMenu() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
}

// Fecha o menu ao pressionar ESC
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if (sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    }
});

// Carrosel
document.addEventListener('DOMContentLoaded', () => {
    const cardsWrapper = document.getElementById('cardsWrapper');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const cardWidth = 500; // Largura do card + margem

    prevBtn.addEventListener('click', () => {
        cardsWrapper.scrollLeft -= cardWidth;
    });

    nextBtn.addEventListener('click', () => {
        cardsWrapper.scrollLeft += cardWidth;
    });
});
