document.addEventListener("DOMContentLoaded", () => {
  const menu = document.querySelector(".menu");
  let bgVisible = false;

  const marker = document.getElementById("marker-menu");
  const items = document.querySelectorAll(".menu-button");

  // get all buttons on menu
  items.forEach((element) => {
    // when click in a button
    element.addEventListener("click", (e) => {
      e.preventDefault();

      // get link in the section
      const targetId = element
        .querySelector("a")
        .getAttribute("href")
        .substring(2);

      // get section with id
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        // create offset to adjust scroll position
        const offset = window.innerHeight / 2 - 50;

        window.scrollTo({
          top: targetElement.offsetTop - offset,
          behavior: "smooth",
        });
      }
    });
  });

  // listener for position marker
  window.addEventListener("resize", function () {
    getCurrentSection();
  });

  window.addEventListener("click", function () {
    getCurrentSection();
  });

  window.addEventListener("scroll", function () {
    getCurrentSection();

    // bg management for menu
    if (window.scrollY > 0 && !bgVisible) {
      bgVisible = true;
      menu.classList.add("bg-secondary", "border-color");
    } else if (window.scrollY == 0 && bgVisible) {
      bgVisible = false;
      menu.classList.remove("bg-secondary", "border-color");
    }
  });

  // get current section and position marker
  function getCurrentSection() {
    const sections = document.querySelectorAll(".section");
    let current = null;

    // check if section in center of screen
    for (let index = 0; index < sections.length; index++) {
      let rect = sections[index].getBoundingClientRect();

      if (
        rect.top <= window.innerHeight / 2 &&
        rect.bottom >= window.innerHeight / 2
      ) {
        current = index;
        marker.style.left = items[current].offsetLeft + "px";
        marker.style.width = items[current].offsetWidth + "px";
        return;
      }
    }

    marker.style.width = 0 + "px";
  }
});
