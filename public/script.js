let slideIndex = 0;
const slides = document.getElementsByClassName("slide");

function initSlides() {
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.left = "100%";
    }
}

function startIntroAnimation() {
    document.querySelector('.slideshow-container').classList.add('intro-animation');

    // Shorter delay for the overlapping effect in the intro animation
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.animationDelay = `${i * 0.2}s`;
    }

    // Start the regular slideshow immediately after the intro
    setTimeout(() => {
        document.querySelector('.slideshow-container').classList.remove('intro-animation');
        showSlide();
        setInterval(showSlide, 4000); // Regular interval for slideshow
    }, slides.length * 400 + 1100); // Shortened total intro duration
}

function showSlide() {
    slides[slideIndex].style.transition = "left 2s ease-in-out";
    slides[slideIndex].style.left = "-100%";
    slideIndex = (slideIndex + 1) % slides.length;
    slides[slideIndex].style.transition = "none";
    slides[slideIndex].style.left = "100%";
    setTimeout(() => {
        slides[slideIndex].style.transition = "left 2s ease-in-out";
        slides[slideIndex].style.left = "0";
    }, 20);
}

initSlides();
startIntroAnimation();