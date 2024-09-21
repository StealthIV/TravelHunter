const slidePage = document.querySelector(".form-outer");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");
let current = 1;

nextBtnFirst.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "-25%";
    updateProgress();
});

nextBtnSec.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "-50%";
    updateProgress();
});

nextBtnThird.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "-75%";
    updateProgress();
});

submitBtn.addEventListener("click", function() {
    updateProgress();
    setTimeout(function() {
        alert("Your Form Successfully Signed up");
        location.reload();
    }, 800);
});

prevBtnSec.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "0%";
    current -= 1;
    updateProgress(-1);
});

prevBtnThird.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "-25%";
    current -= 1;
    updateProgress(-1);
});

prevBtnFourth.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "-50%";
    current -= 1;
    updateProgress(-1);
});

// Function to update progress
function updateProgress(direction = 1) {
    if (direction === 1) {
        bullet[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        current += 1;
    } else {
        bullet[current - 2].classList.remove("active");
        progressCheck[current - 2].classList.remove("active");
        progressText[current - 2].classList.remove("active");
    }
}
