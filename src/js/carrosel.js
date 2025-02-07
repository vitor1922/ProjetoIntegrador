const track = document.querySelector('.custom-carousel .carousel-track');
const items = document.querySelectorAll('.custom-carousel .carousel-item');
const prevButton = document.querySelector('.custom-carousel .control.prev');
const nextButton = document.querySelector('.custom-carousel .control.next');
const indicators = document.querySelectorAll('.custom-carousel .indicator');
let currentIndex = 0;

function updateCarousel() {
  const itemWidth = items[0].getBoundingClientRect().width;
  track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
  indicators.forEach((indicator, index) => {
    indicator.classList.toggle('active', index === currentIndex);
  });
}

nextButton.addEventListener('click', () => {
  currentIndex = (currentIndex + 1) % items.length;
  updateCarousel();
});

prevButton.addEventListener('click', () => {
  currentIndex = (currentIndex - 1 + items.length) % items.length;
  updateCarousel();
});

indicators.forEach((indicator) => {
  indicator.addEventListener('click', () => {
    currentIndex = parseInt(indicator.dataset.index);
    updateCarousel();
  });
});

window.addEventListener('resize', updateCarousel);
