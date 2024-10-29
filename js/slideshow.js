/* Скрипт циклично переключает слайды каждые 2 секунды, 
используя функцию setInterval.*/

document.addEventListener("DOMContentLoaded", function () {
  const slideshows = document.querySelectorAll(".slideshow-container");

  slideshows.forEach(function (slideshow) {
    let slides = slideshow.querySelectorAll(".slide");
    let currentSlide = 0;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.style.opacity = i === index ? "1" : "0";
      });
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }

    setInterval(nextSlide, 2000); // Меняем слайд каждые 2 секунды
    showSlide(currentSlide); // Показать первый слайд
  });
});
