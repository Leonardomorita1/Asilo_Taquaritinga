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
// JavaScript para Animações de Scroll
// Adicione este código ao seu arquivo global.js ou crie um arquivo separado

// Função para verificar se o elemento está visível na viewport
function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Função alternativa que permite mais controle
function isElementVisible(el, threshold = 0.1) {
    const rect = el.getBoundingClientRect();
    const windowHeight = window.innerHeight || document.documentElement.clientHeight;
    
    // Elemento está visível se pelo menos 'threshold' % dele está na viewport
    const verticalVisible = (rect.top <= windowHeight * (1 - threshold)) && 
                           (rect.bottom >= windowHeight * threshold);
    
    return verticalVisible;
}

// Função principal de animação de scroll
function handleScrollAnimations() {
    const animatedElements = document.querySelectorAll(
        '.fade-in-up, .fade-in-down, .fade-in-left, .fade-in-right, .zoom-in, .rotate-in, .card-animate, .scroll-animate'
    );
    
    animatedElements.forEach(element => {
        if (isElementVisible(element, 0.15)) {
            element.classList.add('active');
        }
    });
}

// Inicializar animações quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    // Executar uma vez ao carregar a página
    handleScrollAnimations();
    
    // Executar ao fazer scroll
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        // Debounce para melhor performance
        if (scrollTimeout) {
            window.cancelAnimationFrame(scrollTimeout);
        }
        
        scrollTimeout = window.requestAnimationFrame(function() {
            handleScrollAnimations();
        });
    });
    
    // Executar ao redimensionar a janela
    window.addEventListener('resize', handleScrollAnimations);
});

// Função para animar contadores (números)
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16); // 60fps
    
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(start);
        }
    }, 16);
}

// Função para animar elementos em sequência (cascata)
function animateSequence(selector, delay = 100) {
    const elements = document.querySelectorAll(selector);
    elements.forEach((element, index) => {
        setTimeout(() => {
            element.classList.add('active');
        }, index * delay);
    });
}

// Observer API para animações mais eficientes (alternativa moderna)
if ('IntersectionObserver' in window) {
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                // Opcional: parar de observar após animar
                // observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observar elementos com a classe .observe
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.observe').forEach(el => {
            observer.observe(el);
        });
    });
}