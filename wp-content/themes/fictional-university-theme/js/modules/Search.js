import $ from 'jquery';

class Search {
  constructor() {
    this.openButton = $('.js-search-trigger');
    this.closeButton = $('.search-overlay__close');
    this.searchOverlay = $('.search-overlay');
    this.searchField = $('#search-term');
    this.events();
    this.isOverlayOpen = false;
    this.typingTimer;
  }

  // events
  events() {
    // on method changes what this is to the object that was clicked 
    // we solve this by adding .bind(this)
    this.openButton.on('click', this.openOverlay.bind(this));
    this.closeButton.on('click', this.closeOverlay.bind(this));
    $(document).on('keydown', this.keyPressDispatcher.bind(this));
    this.searchField.on('keydown', this.typingLogic.bind(this));
  }

  // methods
  openOverlay() {
    this.searchOverlay.addClass('search-overlay--active');
    $('body').addClass('body-no-scroll'); // css class is overflow: hidden;
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass('search-overlay--active');
    $('body').removeClass('body-no-scroll');
    this.isOverlayOpen = false;
  }

  keyPressDispatcher(e) {
    if(e.keyCode === 83 && !this.isOverlayOpen) {
      this.openOverlay();
    } else if(e.keyCode === 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  typingLogic() {
    // this will make the timer count only when the last key was pressed
    // this will prevent auto searching every keypress event
    clearTimeout(this.typingTimer);
    this.typingTimer = setTimeout(function() {
      console.log('nice');
    }, 1000);
  }
}

export default Search;