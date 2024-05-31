export class Article {
  constructor(blog) {
    this.blog = blog;
  }

  _setImages() {
    if (this.blog.blogImages.length == 0) return "";

    let content = `<hr class="border-color my-2">
                 <div class="carousel-blog carousel m-auto mt-4 w-4/5 max-lg:w-full relative">
                  <div class="max-sm:hidden carousel-control absolute w-full h-full pointer-events-none	flex justify-between items-center px-2">
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
                
                  <div class="carousel-container h-full w-full">
                  <div class="carousel-items cursor-pointer flex items-center  overflow-y-hidden  sm:overflow-x-hidden snap-mandatory snap-x h-full w-full">`;

    this.blog.blogImages.forEach((image) => {
      content += `<img class="image snap-center object-cover h-full" src="/images/articles/${image.imageName}">`;
    });

    content += "</div></div>";

    return content;
  }

  createArticle() {
    const date = new Date(this.blog.createdAt);

    const month = {
      1: "Jan",
      2: "Feb",
      3: "March",
      4: "May",
      5: "April",
      6: "June",
      7: "July",
      8: "August",
      9: "September",
      10: "October",
      11: "November",
      12: "December",
    };

    const formatedDate = `${
      month[date.getMonth()]
    } ${date.getDate()}, ${date.getFullYear()}`;

    return `<article class="tab px-2 max-lg:px-0 py-4 border-color border-[1px] border-l-0 border-r-0  transition-all duration-150 ease-in-out">
    <div class="flex justify-between items-center gap-2 ">
    <h3 class="text-blue font-medium text-2xl">
    ${this.blog.name}
      </h3>
      <button class="link btn-link see-more-js">
      <div class="text-gray-200 pr-2">
        Show more
      </div>
      <svg class=" arrow transition-all duration-150 ease-in-out -rotate-90" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewbox="0 0 1024 1024">
        <path fill="currentColor" d="M104.704 338.752a64 64 0 0 1 90.496 0l316.8 316.8l316.8-316.8a64 64 0 0 1 90.496 90.496L557.248 791.296a64 64 0 0 1-90.496 0L104.704 429.248a64 64 0 0 1 0-90.496"/>
      </svg>
    </button>
    </div>
    <p  class="text-sm text-gray-500  pt-3">
      Created at ${formatedDate}
    </p>
    <div class="hidden detail pb-4">
      <hr class="border-color my-2">
      <div name="blog-content" class="p-4 max-lg:p-2">
        ${this.blog.detail}
      </div>
           ${this._setImages()}
    </div>
  </article>`;
  }
}

//