/**
 * Class to create a carousel with option
 *
 * autoplay autoplay carousel
 * no-interaction disable show image modal
 * hide-buttons disable control of carousel
 */

export class Carousel {
  constructor(carousel, delay = 5000) {
    this.carousel = carousel;
    this.container = this.carousel.querySelector(".carousel-container");
    this.items;
    this.currentItem = 0;
    this.isScrolling = false;

    this.animationAutoplay;
    this.delay = delay;
    // initialize
    this.setCarousel();
  }

  setCarousel() {
    // get slides
    this.items = this.getItems();

    const hideButton = this.carousel.hasAttribute("hide-buttons");
    const autoPlay = this.carousel.hasAttribute("autoplay");
    const noInteraction = this.carousel.hasAttribute("no-interaction");

    if (hideButton || this.items.length <= 1) {
      console.log("hide");
      this.carousel.querySelector(".carousel-control").classList.add("hidden");

      return;
    }

    if (noInteraction) this.disableInteractionImage();
    if (autoPlay) this.autoplay();

    // listen buttons
    this.previous();
    this.next();
  }

  getItems() {
    const items = this.carousel.querySelector(".carousel-items").children;
    return items;
  }

  previous() {
    const button = this.carousel.querySelector(".carousel-control").children[0];

    button.addEventListener("click", (e) => {
      e.stopPropagation();
      clearTimeout(this.animationAutoplay);

      this.changeSlide(this.currentItem - 1);
    });
  }

  next() {
    const button = this.carousel.querySelector(".carousel-control").children[1];

    button.addEventListener("click", (e) => {
      e.stopPropagation();

      clearTimeout(this.animationAutoplay);

      this.changeSlide(this.currentItem + 1);
    });
  }

  changeSlide(index) {
    if (this.isScrolling) return;

    this.isScrolling = true;

    let moveForward = index > this.currentItem;

    if (index < 0) {
      index = this.items.length - 1;
    } else if (index >= this.items.length - 1) {
      index = 0;
    }

    if (moveForward) {
      this.scrollToItem(moveForward);
    } else {
      // insert last element on the first position before scroll
      this.container.children[0].insertBefore(
        this.items[this.items.length - 1],
        this.container.children[0].firstChild
      );

      this.scrollToItem(moveForward);
    }

    // timeout to
    setTimeout(() => {
      if (moveForward) {
        // Move the current item to the end if scrolling forward
        this.container.children[0].appendChild(this.items[0]);
      }

      this.isScrolling = false;
      this.currentItem = index;

      if (this.autoplay) {
        this.autoplay();
      }
    }, 500);
  }

  scrollToItem(moveForward) {
    this.container.scrollTo({
      behavior: "smooth",
      left: this.items[moveForward ? 1 : 0].offsetLeft,
    });
  }

  autoplay() {
    this.animationAutoplay = setTimeout(() => {
      this.changeSlide(this.currentItem + 1);
    }, this.delay);
  }

  disableInteractionImage() {
    for (const item of this.items) {
      item.classList.remove("image");
    }
  }
}

const carousels = document.querySelectorAll(".carousel");
carousels.forEach((carousel) => {
  new Carousel(carousel);
});
