function Search() {
  const openButton = document.getElementById("search");
  const closeButton = document.getElementById("close-overlay");
  const searchOverlay = document.getElementById("overlay");
  const body = document.body;
  const searchTerm = document.getElementById("search-term");
  let typingTimeout;
  const resultsDiv = document.getElementById("search-overlay__results");
  let isSpinnerVisible = false;
  let previusValue;

  openButton.addEventListener("click", function() {
    searchOverlay.classList.add("search-overlay--active");
    body.classList.add("body-no-scroll");
  });
  closeButton.addEventListener("click", function() {
    searchOverlay.classList.remove("search-overlay--active");
    body.classList.remove("body-no-scroll");
  });

  searchTerm.addEventListener("keyup", function() {
    if (searchTerm.value != previusValue) {
      clearTimeout(typingTimeout);
      if (searchTerm.value) {
        if (!isSpinnerVisible) {
          let div = document.createElement("div");
          div.className = "spinner-loader";
          resultsDiv.appendChild(div);
          isSpinnerVisible = true;
        }
        typingTimeout = setTimeout(function() {
          let url = `http://localhost:8000/wp-json/wp/v2/posts?search=${
            searchTerm.value
          }`;
          fetch(url)
            .then(res => res.json())
            .then(posts => {
              console.log(posts);
              resultsDiv.innerHTML = `
              <h2 class="search-overlay__section-title">General Information
              <ul class="link-list min list">
                ${posts
                  .map(
                    item =>
                      `<li><a href="${item.link}">${
                        item.title.rendered
                      }</a></li>`
                  )
                  .join("")}
              </ul>
              </h2>`;
            });
          isSpinnerVisible = false;
        }, 2000);
      } else {
        resultsDiv.innerHTML = "";
        isSpinnerVisible = false;
      }
    }
    previusValue = searchTerm.value;
  });
}

export default Search;
