import { ListenImage } from "./dialogImage.js";

export class TabManager {
  constructor() {
    this.previousTabs = [];
  }

  setTabInteractive() {
    // delete old listener to avoid duplication
    this.previousTabs.forEach(({ tab, listener }) => {
      tab.removeEventListener("click", listener);
    });

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
        detail.classList.toggle("fade");
        detail.classList.toggle("hidden");
      };

      tab.addEventListener("click", listener);

      // add to previous tab's
      this.previousTabs.push({ tab, listener });
    });

    ListenImage();
  }
}
