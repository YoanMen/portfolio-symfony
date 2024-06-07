export class Article {
  constructor(blog) {
    this.blog = blog;
  }

  _setImages() {
    if (this.blog.blogImages.length == 0) return "";

    let content = `<div class="carousel carousel-blog m-auto mt-4 w-4/5 max-lg:w-full relative">
                    <div class="max-sm:hidden carousel-control absolute w-full h-full pointer-events-none	flex justify-between items-center px-2">
                      <button class="pointer-events-auto rounded-full bg-secondary opacity-85 hover:opacity-100 active:opacity-90 size-12 border-2 border-color">
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
                      <div class="carousel-items cursor-zoom-in	flex overflow-y-hidden sm:overflow-x-hidden snap-mandatory snap-x">`;

    const totalImages = this.blog.blogImages.length;
    let firstImage = this.blog.blogImages[0];

    if (totalImages > 1) {
      this.blog.blogImages.forEach((image) => {
        content += `<img class="image snap-center object-scale-down flex-shrink-0 w-full max-h-96" src="/images/articles/${image.imageName}">`;
      });

      // duplicate first image for infinite scroll
      content += `<img class="image snap-center object-scale-down flex-shrink-0 w-full max-h-96 last:max-sm:hidden" src="/images/articles/${firstImage.imageName}">`;
    } else {
      content += `<img class="image snap-center object-scale-down flex-shrink-0 w-full max-h-96" src="/images/articles/${firstImage.imageName}">`;
    }

    content += "</div></div>";
    return content;
  }

  createArticle() {
    const date = new Date(this.blog.createdAt);

    const month = {
      1: "Jan",
      2: "Feb",
      3: "March",
      4: "April",
      5: "May",
      6: "June",
      7: "July",
      8: "August",
      9: "September",
      10: "October",
      11: "November",
      12: "December",
    };

    const formatedDate = `${
      month[date.getMonth() + 1]
    } ${date.getDate()}, ${date.getFullYear()}`;

    return `<article class="tab px-2 max-lg:px-0 py-8 border-color first:border-t-[1px] border-b-[1px] border-l-0 border-r-0  transition-all duration-150 ease-in-out">
    <div class="flex justify-between items-center">
    <h3 class="text-blue font-medium text-2xl">
    ${this.blog.name}
      </h3>
      <button class="link btn-link see-more-js">
        <div class="text-color text-sm font-light pr-2">
					Show more
				</div>
				<svg class=" arrow transition-all duration-150 ease-in-out rotate-0" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewbox="0 0 24 24">
					<path fill="currentColor" d="M8 5v14l11-7z"/>
				</svg>
			</button>
    </div>
    <p  class="max-lg:ml-1  text-sm text-color opacity-60 ">
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
