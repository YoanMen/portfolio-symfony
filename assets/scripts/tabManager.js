import { ListenImage } from "./dialogImage.js";

export class TabManager {
  constructor() {
    this.previousTabs = [];
  }

  setTabInteractive() {
    // delete old listener to avoid duplication
    this.previousTabs.forEach(({ tab, listener }) => {
      const button = tab.querySelector(".see-more-js");

      button.removeEventListener("click", listener);
    });

    // get all tab's
    const tabs = document.querySelectorAll(".tab");

    tabs.forEach((tab) => {
      const listener = () => {
        const arrow = tab.querySelector(".arrow");
        arrow.classList.toggle("rotate-90");

        const detail = tab.querySelector(".detail");
        detail.classList.toggle("fade");
        detail.classList.toggle("hidden");
      };
      const button = tab.querySelector(".see-more-js");

      button.addEventListener("click", listener);

      // add to previous tab's
      this.previousTabs.push({ tab, listener });
    });

    ListenImage();
  }
}
