import { TabManager } from "./tabManager.js";
import { Carousel } from "./carousel.js";
import { Article } from "./blogArticle.js";

window.onload = () => {
  // Get blog posts
  const tabManager = new TabManager();

  const blogsContainer = document.querySelector("#blog-container");
  const loadBlogs = document.querySelector("#load-blogs");
  const pagination = document.querySelector("#pagination-blog");
  let pageLinks;

  const searchInput = document.querySelector("#search-blog");
  let finishTimer;

  if (searchInput) {
    searchInput.addEventListener("input", () => {
      clearTimeout(finishTimer);

      finishTimer = setTimeout(() => {
        getBlogPosts();
      }, 500);
    });
  }

  if (blogsContainer) getBlogPosts();

  async function getBlogPosts(page = 1) {
    blogsContainer.textContent = "";
    loadBlogs.classList.toggle("hidden");
    const response = await fetch(
      `api/blog?page=${page}&search=${searchInput.value}`,
      {
        method: "GET",
        headers: { "Content-Type": "application/json" },
      }
    )
      .then((response) => response.json())
      .catch(() => alert.error("Error get blogs"));

    loadBlogs.classList.toggle("hidden");

    if (response == null) return;

    setBlogs(response.data);
    await setPagination(response.page, response.maxPage);

    //
    const carousels = document.querySelectorAll(".carousel-blog");

    carousels.forEach((carousel) => {
      new Carousel(carousel);
    });
    listeningClickPageLink();
  }

  function setBlogs(data) {
    let content = "";
    data.forEach((blog) => {
      const article = new Article(blog);

      content += article.createArticle();
    });

    blogsContainer.insertAdjacentHTML("afterbegin", content);
    tabManager.setTabInteractive();
  }

  async function setPagination(page, maxPage) {
    let content = "";

    if (maxPage == 1) return;
    for (let index = 0; index < maxPage; index++) {
      if (index + 1 == page) {
        content += `<a data-page=${index + 1} class="page text-2xl" href="#">${
          index + 1
        }</a>`;
      } else {
        content += `<a data-page=${index + 1} class="page text-xl" href="#">${
          index + 1
        }</a>`;
      }
    }

    pagination.textContent = "";
    pagination.insertAdjacentHTML("afterbegin", content);

    pageLinks = document.querySelectorAll(".page");
  }

  function listeningClickPageLink() {
    if (!pageLinks) return;
    pageLinks.forEach((pageLink) => {
      pageLink.addEventListener("click", (event) => {
        event.preventDefault();

        const selectedPage = pageLink.dataset.page;

        // load new blogs
        getBlogPosts(selectedPage);
      });
    });
  }
};
