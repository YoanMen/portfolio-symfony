export function setTabInteractive() {
  const tabs = document.querySelectorAll(".tab");
  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      const links = tab.querySelectorAll(".link");
      const arrow = tab.querySelector(".arrow");
      arrow.classList.toggle("rotate-0");

      if (links) {
        links.forEach((link) => {
          link.addEventListener("click", (e) => {
            e.stopPropagation();
            console.log("click");
          });
        });
      }
      console.log(tab);
      const detail = tab.querySelector(".detail");
      detail.classList.toggle("hidden");
    });
  });
}

// need to remove listerner before listening
