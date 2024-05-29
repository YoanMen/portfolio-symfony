import { TabManager } from "./tabManager.js";
import { Carousel } from "./carousel.js";
window.onload = () => {
  // Get blog posts
  const tabManager = new TabManager();

  const blogsContainer = document.querySelector("#blog-container");
  const loadBlogs = document.querySelector("#load-blogs");
  const pagination = document.querySelector("#pagination-blog");
  let pageLinks;

  const searchInput = document.querySelector("#search-blog");
  let finishTimer;

  searchInput.addEventListener("input", () => {
    clearTimeout(finishTimer);

    finishTimer = setTimeout(() => {
      getBlogPosts();
    }, 500);
  });

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
      // set image to blog
      function setImages() {
        if (blog.blogImages.length == 0) return "";

        content = ` <hr class="border-color my-8">
                     <div autoplay class="carousel-blog mx-auto h-[480px] w-full relative max-w-3xl">
                      <div class="carousel-control absolute w-full h-full pointer-events-none	flex justify-between items-center px-2">
                        <button class="pointer-events-auto rounded-full bg-secondary opacity-85 hover:opacity-100 active:opacity-90 size-12 border-2 border-color ">
                          <svg class=" m-auto rotate-90 " xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewbox="0 0 1024 1024">
                            <path fill="currentColor" d="M104.704 338.752a64 64 0 0 1 90.496 0l316.8 316.8l316.8-316.8a64 64 0 0 1 90.496 90.496L557.248 791.296a64 64 0 0 1-90.496 0L104.704 429.248a64 64 0 0 1 0-90.496"/>
                          </svg>
                        </button>
                        <button class="pointer-events-auto rounded-full bg-secondary opacity-85 hover:opacity-100 active:opacity-90 size-12 border-2 border-color ">
                          <svg class=" m-auto -rotate-90 " xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewbox="0 0 1024 1024">
                            <path fill="currentColor" d="M104.704 338.752a64 64 0 0 1 90.496 0l316.8 316.8l316.8-316.8a64 64 0 0 1 90.496 90.496L557.248 791.296a64 64 0 0 1-90.496 0L104.704 429.248a64 64 0 0 1 0-90.496"/>
                          </svg>
                        </button>
                      </div>
                    
                      <div class="carousel-container h-full mx-auto snap-mandatory snap-x overflow-hidden ">
                        <div class="carousel-items cursor-pointer w-full h-full flex">
        `;

        blog.blogImages.forEach((image) => {
          content += `<img class="w-full h-full image flex-shrink-0 object-scale-down snap-center" src="/images/articles/${image.imageName}">`;
        });

        content += "</div></div>";

        return content;
      }

      const date = new Date(blog.createdAt);

      content += `<article class="tab p-2 rounded border-color border-[1px] cursor-pointer hover:border-[#2276f5] hover:bg-black hover:bg-opacity-5 transition-all duration-150 ease-in-out">
                  <div class="flex justify-between">
                    <h3 class="text-blue font-bold text-xl mb-2">
                      ${blog.name}
                    </h3>
                    <div class=" arrow-js ">
                      <svg class="arrow transition-all duration-150 ease-in-out -rotate-90" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewbox="0 0 1024 1024">
                        <path fill="currentColor" d="M104.704 338.752a64 64 0 0 1 90.496 0l316.8 316.8l316.8-316.8a64 64 0 0 1 90.496 90.496L557.248 791.296a64 64 0 0 1-90.496 0L104.704 429.248a64 64 0 0 1 0-90.496"/>
                      </svg>
                    </div>
                  </div>
                  <p class=" text-xs ">
                    created at ${date.toLocaleDateString()}
                  </p>
                  <div class="hidden detail pb-4">
                    <hr class="border-color my-2">
                    <div name="project content" >
                      ${blog.detail}
                    </div>
                        ${setImages()}
                  </div>
                </article>`;
    });

    console.log(surligneSearchInput(content));
    content = surligneSearchInput(content);
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

  function surligneSearchInput(content) {
    if (searchInput.value.length > 1) {
      return content.replaceAll(
        searchInput.value.trim(),
        `<strong class="surligne">${searchInput.value.trim()}</strong>`
      );
    }
    return content;
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
