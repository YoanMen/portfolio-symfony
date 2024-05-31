document.addEventListener("DOMContentLoaded", () => {
  const showButton = document.querySelector(".show-js");
  let isVisible = true;

  showButton.addEventListener("click", () => {
    if (isVisible) {
      const windowsHeight = window.innerHeight;

      window.scrollTo({
        behavior: "smooth",
        top: windowsHeight - 80,
      });
    }
  });

  document.addEventListener("scroll", () => {
    let scrollPosition = window.scrollY;

    if (scrollPosition > 0 && isVisible) {
      console.log("ok");
      isVisible = false;
      showButton.classList.add("fade-out");
      showButton.classList.remove("fade");
    } else if (scrollPosition == 0 && !isVisible) {
      isVisible = true;
      showButton.classList.remove("fade-out");
      showButton.classList.add("fade");
    }
  });
});
