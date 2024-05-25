document.addEventListener("DOMContentLoaded", () => {
  const body = document.querySelector("body");
  const btn = document.querySelector(".theme__btn");

  if (window.matchMedia("(prefers-color-scheme: light)").matches)
    body.classList.add("light-mode");

  btn.addEventListener("click", () => {
    body.classList.toggle("light-mode");
  });
});
