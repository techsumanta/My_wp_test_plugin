<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    *,
*::after,
*::before {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
  --unhover-border-color: rgba(0, 0, 0, 0.5);
  --unhover-text-color: rgba(255, 255, 255, 0.5);
  --unhover-background-color: rgba(0, 0, 0, 0.5);

  --hover-border-color: rgba(0, 0, 0, 0.8);
  --hover-text-color: rgba(255, 255, 255, 0.8);
  --hover-background-color: rgba(0, 0, 0, 0.8);

  --transition-delay: 0.5s;
}

.carousel {
  position: relative;
  width: 100vw;
  height: 100vh;
}

.slider-button {
  font-size: 1rem;
  padding: 5px 1rem;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: var(--unhover-background-color);
  border: 2px solid var(--unhover-border-color);
  color: var(--unhover-text-color);
  z-index: 10;
  cursor: pointer;
}

.slider-button-prev {
  left: 2rem;
}

.slider-button-next {
  right: 2rem;
}

.slider-button:hover,
.slider-button:focus {
  background-color: var(--hover-background-color);
  border: 2px solid var(--hover-border-color);
  color: var(--hover-text-color);
}

ul.slides {
  list-style-type: none;
  height: 100%;
  width: 100%;
}

li.slide {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  overflow: hidden;
  opacity: 0;
  transition: opacity var(--transition-delay);
  transition-delay: var(--transition-delay);
}

.slide > img {
  height: 100%;
  width: 100%;
  object-fit: cover;
  object-position: center;
}

li.slide[data-active-slide] {
  opacity: 1;
}

.slides-circles {
  display: flex;
  position: absolute;
  bottom: 3rem;
  left: 50%;
  transform: translateX(-50%);
  overflow: hidden;
}

.slides-circles > div {
  height: 20px;
  width: 20px;
  margin: 10px;
  border: 3px solid white;
  border-radius: 50%;
  transition: background-color var(--transition-delay);
  transition-delay: var(--transition-delay);
}

.slides-circles > div[data-active-slide] {
  background-color: white;
}


</style>  
</head>
  <body>
  <section class="carousel">
  <button class="slider-button slider-button-prev" data-slide-direction="prev">&#8592</button>
  <button class="slider-button slider-button-next" data-slide-direction="next">&#8594</button>
  <ul class="slides">
    <li class="slide" data-active-slide>
      <img src="https://img.freepik.com/free-photo/beautiful-tree-middle-field-covered-with-grass-with-tree-line-background_181624-29267.jpg?w=1060&t=st=1670093487~exp=1670094087~hmac=0efe31cac4ad9457031ff3a8b14f9be760a038fae38f101b8a292c1f766e725e" alt="Nature Image #1" />
    </li>
    <li class="slide">
      <img src="https://img.freepik.com/free-photo/vestrahorn-mountains-stokksnes-iceland_335224-667.jpg?w=1060&t=st=1670093535~exp=1670094135~hmac=27728351e326c808a35c161c98c1d8ff9e6328c4ceb471c2725c4cc3cf94c0c2" alt="Nature Image #2" />
    </li>
    <li class="slide">
      <img src="https://img.freepik.com/free-photo/beautiful-shot-grassy-hills-covered-trees-near-mountains-dolomites-italy_181624-24400.jpg?w=900&t=st=1670093563~exp=1670094163~hmac=53dd76fac233cfc81416be6e48979f21ca375c70470fba4b50eea93c9e27cee9" alt="Nature Image #3" />
    </li>
  </ul>
  <div class="slides-circles">
    <div data-active-slide></div>
    <div></div>
    <div></div>
  </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
       const buttons = document.querySelectorAll("[data-slide-direction]");

buttons.forEach((button) => {
  button.addEventListener("click", () => {
    const offset = button.dataset.slideDirection === "next" ? 1 : -1;
    changeSlide(offset);
  });
});

const changeSlide = (offset) => {
  const slides = document.querySelector(".slides");
  const activeSlide = slides.querySelector("[data-active-slide]");
  let newIndex = [...slides.children].indexOf(activeSlide) + offset;
  newIndex =
    newIndex < 0
      ? slides.children.length - 1
      : newIndex === slides.children.length
      ? 0
      : newIndex;
  slides.children[newIndex].dataset.activeSlide = true;
  delete activeSlide.dataset.activeSlide;

  const circles = document.querySelector(".slides-circles");
  const activeCircle = circles.querySelector("[data-active-slide]");
  circles.children[newIndex].dataset.activeSlide = true;
  delete activeCircle.dataset.activeSlide;
};

setInterval(changeSlide.bind(null, 1), 6000);

    </script>
  </body>
</html>