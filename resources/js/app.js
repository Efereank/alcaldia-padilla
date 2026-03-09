import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Menú hamburguesa
document.addEventListener('DOMContentLoaded', function() {
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const navMenu = document.getElementById('navMenu');
    
    if (!hamburgerBtn || !navMenu) return;
    
    hamburgerBtn.addEventListener('click', function() {
        this.classList.toggle('active');
        navMenu.classList.toggle('active');
    });
    
    // Cerrar solo con enlaces que no sean dropdown
    navMenu.querySelectorAll('a:not(.dropdown-trigger)').forEach(link => {
        link.addEventListener('click', function() {
            hamburgerBtn.classList.remove('active');
            navMenu.classList.remove('active');
        });
    });
});

// ===== CARRUSEL DE BANNERS =====
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const prevBtn = document.getElementById('prevSlide');
    const nextBtn = document.getElementById('nextSlide');
    
    // Si no hay slides, salir
    if (!slides.length) return;
    
    let currentSlide = 0;
    let slideInterval;
    
    // Función para mostrar slide específico
    function showSlide(index) {
        // Validar límites
        if (index >= slides.length) index = 0;
        if (index < 0) index = slides.length - 1;
        
        // Remover clase active de todos
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Agregar clase active al slide actual
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        
        currentSlide = index;
    }
    
    // Función para siguiente slide
    function nextSlide() {
        showSlide(currentSlide + 1);
    }
    
    // Función para slide anterior
    function prevSlide() {
        showSlide(currentSlide - 1);
    }
    
    // Event listeners para botones
    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            prevSlide();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            nextSlide();
        });
    }
    
    // Event listeners para dots (indicadores)
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            showSlide(index);
        });
    });
    
    // Auto-play cada 5 segundos
    function startAutoPlay() {
        if (slideInterval) clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5000);
    }
    
    function stopAutoPlay() {
        if (slideInterval) {
            clearInterval(slideInterval);
            slideInterval = null;
        }
    }
    
    // Iniciar auto-play
    startAutoPlay();
    
    // Pausar auto-play al hacer hover sobre el carrusel
    const carouselContainer = document.querySelector('.carousel-container');
    if (carouselContainer) {
        carouselContainer.addEventListener('mouseenter', stopAutoPlay);
        carouselContainer.addEventListener('mouseleave', startAutoPlay);
    }
    
    // Pausar auto-play al hacer hover sobre los controles
    [prevBtn, nextBtn].forEach(btn => {
        if (btn) {
            btn.addEventListener('mouseenter', stopAutoPlay);
            btn.addEventListener('mouseleave', startAutoPlay);
        }
    });
    
    // Soporte para teclado (flechas izquierda/derecha)
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            prevSlide();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
        }
    });
});