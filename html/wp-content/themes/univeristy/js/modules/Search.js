function Search() {
  const openButton = document.getElementById('search');
  const closeButton = document.getElementById('close-overlay');
  const searchOverlay = document.getElementById('overlay');
  const body = document.body;
  const searchTerm = document.getElementById('search-term');
  let typingTimeout;
  const resultsDiv = document.getElementById('search-overlay__results');
  let isSpinnerVisible = false;
  let previusValue;

  openButton.addEventListener('click', function () {
    searchOverlay.classList.add('search-overlay--active')
    body.classList.add('body-no-scroll')

  });
  closeButton.addEventListener('click', function () {
    searchOverlay.classList.remove('search-overlay--active')
    body.classList.remove('body-no-scroll')
  });

  searchTerm.addEventListener('keyup', function () {
    if (searchTerm.value != previusValue) {
      clearTimeout(typingTimeout);
      if (searchTerm.value) {
        if (!isSpinnerVisible) {
          let div = document.createElement('div');
          div.className = 'spinner-loader';
          resultsDiv.appendChild(div)
          isSpinnerVisible = true
        }
        typingTimeout = setTimeout(function () {
          resultsDiv.textContent = 'This ios the result'
          console.log(searchTerm.value);

          isSpinnerVisible = false
        }, 2000);
      } else {
        resultsDiv.innerHTML = ''
        isSpinnerVisible = false
      }
    }
    previusValue = searchTerm.value
  })
}



export default Search