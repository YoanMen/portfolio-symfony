let previousTabs = [];

export function setTabInteractive() {
  // delete old listener to avoid duplication
  previousTabs.forEach(({ tab, listener }) => {
    tab.removeEventListener("click", listener);
  });

  previousTabs = [];

  // get all tab's
  const tabs = document.querySelectorAll(".tab");

  tabs.forEach((tab) => {
    const listener = () => {
      const links = tab.querySelectorAll(".link");
      const arrow = tab.querySelector(".arrow");
      arrow.classList.toggle("rotate-0");

      if (links) {
        links.forEach((link) => {
          link.addEventListener("click", (e) => {
            e.stopPropagation();
          });
        });
      }

      const detail = tab.querySelector(".detail");
      detail.classList.toggle("hidden");
    };

    tab.addEventListener("click", listener);

    // add to previous tab's
    previousTabs.push({ tab, listener });
  });
}
