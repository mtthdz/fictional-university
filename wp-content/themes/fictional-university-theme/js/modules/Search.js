import $ from 'jquery';

class Search {
  constructor() {
    this.openButton = $('.js-search-trigger');
    this.closeButton = $('.search-overlay__close');
    this.searchOverlay = $('.search-overlay');
    this.searchField = $('#search-term');
    this.resultsDiv = $('#search-overlay__results');
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
  }

  // events
  events() {
    // on method changes what this is to the object that was clicked 
    // we solve this by adding .bind(this)
    this.openButton.on('click', this.openOverlay.bind(this));
    this.closeButton.on('click', this.closeOverlay.bind(this));
    $(document).on('keydown', this.keyPressDispatcher.bind(this));
    this.searchField.on('keyup', this.typingLogic.bind(this));
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
    // checking for open overlay will prevent it multiple keypresses triggering the fn
    // checking for other inputs/textareas will prevent searching in the wrong input/textarea
    if(e.keyCode === 83 && !this.isOverlayOpen && !$('input, textarea').is(':focus')) {
      this.openOverlay();
    } else if(e.keyCode === 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  typingLogic() {
    if(this.searchField.val() != this.previousValue) {
      // this will make the timer count only when the last key was pressed
      // this will prevent auto searching every keypress event
      clearTimeout(this.typingTimer);


      // else: if search field is empty, don't search, remove spinner
      // this will prevent us from calling to wordpress with a blank search bar
      if(this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>')
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 1000);
      } else {
        this.resultsDiv.html('');
        this.isSpinnerVisible = false;
      }
    }

    this.previousValue = this.searchField.val();
  }

  getResults() {
    $.getJSON('http://fictional-university.local/wp-json/wp/v2/posts?search=' + this.searchField.val(), function(posts) {
      alert(posts[0].title.rendered);
    });
  }
}

export default Search;