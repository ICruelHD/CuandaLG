document.addEventListener("DOMContentLoaded", function() {
    const hash = window.location.hash;
    if (hash && document.querySelector('.carousel-item' + hash)) {
      const carousel = new bootstrap.Carousel(document.querySelector('#carrusel'));
      const index = Array.from(document.querySelectorAll('.carousel-item')).findIndex(item => '#' + item.id === hash);
      if (index !== -1) carousel.to(index);
    }
  });