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
      .catch(() => console.error("Error get blogs"));

    loadBlogs.classList.toggle("hidden");
    if (response.success && response != null) {
      setBlogs(response.data);
      setPagination(response.page, response.maxPage);

      const carousels = document.querySelectorAll(".carousel-blog");

      carousels.forEach((carousel) => {
        new Carousel(carousel);
      });
      listeningClickPageLink();
    } else {
      console.error(response.error);
    }
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

  function setPagination(currentPage, maxPage) {
    let content = "";

    if (maxPage == 1) return;
    for (let index = 0; index < maxPage; index++) {
      const page = index + 1;

      if (page == currentPage) {
        content += `<a aria-label="page ${page}" data-page=${page} 
        class="page text-2xl" href="#">${page}</a>`;
      } else {
        content += `<a aria-label="page ${page}" data-page=${page} 
        class="page text-xl" href="#">${page}</a>`;
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
