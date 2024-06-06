export function ListenImage() {
  const images = document.querySelectorAll(".image");
  const modal = document.querySelector("#modal-wrapper");
  const body = document.querySelector("body");

  console.log(images);
  images.forEach((image) => {
    image.addEventListener("click", (event) => {
      event.stopPropagation();

      const img = modal.querySelector("img");
      img.src = image.src;

      body.classList.add("overflow-hidden");
      modal.classList.remove("hidden");

      img.addEventListener("click", (event) => {
        document.querySelector("body").classList.remove("overflow-hidden");
        modal.classList.add("hidden");
      });

      modal.addEventListener("click", (event) => {
        document.querySelector("body").classList.remove("overflow-hidden");
        modal.classList.add("hidden");
      });
    });
  });
}
