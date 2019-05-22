function Search() {
  const openButton = document.getElementById('search');
  const closeButton = document.getElementById('close-overlay');
  const searchOverlay = document.getElementById('overlay');


  openButton.addEventListener('click', function () {
    searchOverlay.classList.add('search-overlay--active')

  });
  closeButton.addEventListener('click', function () {
    searchOverlay.classList.remove('search-overlay--active')
  });
}



export default Search