//Carousel slider for categories

function moveSlide(count) {
    let prevSlide = document.querySelector('.enabled');
    let nextSlide = document.querySelector('[data-slide-'+count+']');
    prevSlide.classList.remove('enabled');
    nextSlide.classList.remove('disabled');
    prevSlide.classList.add('disabled');
    nextSlide.classList.add('enabled');
}

let slideCount = 1;
let sliderAll = document.getElementById('slider-all');
let maxSlides = sliderAll.childElementCount;

let prevBtn = document.querySelectorAll('[data-prev]');
prevBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        if (slideCount === 1) {
            slideCount = maxSlides;
        } else {
            slideCount--;
        }
        moveSlide(slideCount);
    });
});
let nextBtn = document.querySelectorAll('[data-next]');
nextBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        if (slideCount === maxSlides) {
            slideCount = 1;
        } else {
            slideCount++;
        }
        moveSlide(slideCount);
    });
});

