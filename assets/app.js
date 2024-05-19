import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";
import "./scripts/menu.js";
import { setTabInteractive } from "./scripts/sectionTab.js";

window.onload = () => {
  // Get blog posts
  const blogsContainer = document.querySelector("#blog-container");
  const loadBlogs = document.querySelector("#load-blogs");
  const pagination = document.querySelector("#pagination-blog");
  let pageLinks;
  getBlogPosts();

  async function getBlogPosts(page = 1) {
    blogsContainer.innerHTML = "";
    loadBlogs.classList.toggle("hidden");
    const response = await fetch(`api/blog?page=${page}`, {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    })
      .then((response) => response.json())
      .catch(() => console.error("Error get blogs"));

    loadBlogs.classList.toggle("hidden");

    if (response == null) return;

    setBlogs(response.data);
    await setPagination(response.page, response.maxPage);
    listeningClickPageLink();
  }

  function setBlogs(data) {
    let content = "";
    data.forEach((blog) => {
      // set image to blog
      function setImages() {
        console.log(blog.blogImages.length);
        if (blog.blogImages.length == 0) return "";

        let content = `<hr class="border-color my-2">
                        <div class="carousel flex gap-1 overflow-hidden overflow-x-scroll pt-2 pb-6">`;
        console.log(blog);
        blog.blogImages.forEach((image) => {
          content += `<img class="image h-64 object-cover select-none mx-auto" src="/images/articles/${image.imageName}">`;
        });

        content += "</div>";
        return content;
      }

      const date = new Date(blog.createdAt);

      content += `<article class="tab p-2 rounded border-color border-[1px] cursor-pointer hover:border-[#2276f5]">
                  <div class="flex justify-between">
                    <h3 class="text-blue font-bold text-xl mb-2">
                      ${blog.name}
                    </h3>
                    <div class="text-white arrow-js ">
                      <svg class="arrow transition-all duration-150 ease-in-out -rotate-90" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewbox="0 0 1024 1024">
                        <path fill="currentColor" d="M104.704 338.752a64 64 0 0 1 90.496 0l316.8 316.8l316.8-316.8a64 64 0 0 1 90.496 90.496L557.248 791.296a64 64 0 0 1-90.496 0L104.704 429.248a64 64 0 0 1 0-90.496"/>
                      </svg>
                    </div>
                  </div>
                  <p class="text-white text-sm ">
                    created at ${date.toLocaleDateString()}
                  </p>
                  <div class="hidden detail pb-4">
                    <hr class="border-color my-2">
                    <div name="project content" class="text-white">
                      ${blog.detail}
                    </div>
                        ${setImages()}
                  </div>
                </article>`;
    });

    blogsContainer.innerHTML = content;
    setTabInteractive();
  }

  async function setPagination(page, maxPage) {
    let content = "";
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

    pagination.innerHTML = content;

    pageLinks = document.querySelectorAll(".page");
  }

  function listeningClickPageLink() {
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
