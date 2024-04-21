
document.addEventListener('DOMContentLoaded', () => {
    const carousel = new bootstrap.Carousel(document.querySelector('#heroCarousel'), {
        interval: 2000,
        wrap: true,
        touch: true,
    });
});