import $ from 'jquery';

class Search {
  constructor() {
    this.openButton = $('.js-search-trigger');
    this.closeButton = $('.search-overlay__close');
    this.searchOverlay = $('.search-overlay');
    this.events();
  }

  // events
  events() {
    // on method changes what this is to the object that was clicked 
    // we solve this by adding .bind(this)
    this.openButton.on('click', this.openOverlay.bind(this));
    this.closeButton.on('click', this.closeOverlay.bind(this));
  }

  // methods
  openOverlay() {
    this.searchOverlay.addClass('search-overlay--active');
  }

  closeOverlay() {
    this.searchOverlay.removeClass('search-overlay--active');
  }
}

export default Search;