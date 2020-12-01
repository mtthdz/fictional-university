import $ from 'jquery';

class Search {
  constructor() {
    // call this so the user can search
    this.addSearchHTML();
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
    this.searchField.val(''); // set search bar blank everytime overlay is opened
    setTimeout(() => this.searchField.focus(), 301); // automatically focus on textfield when open
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
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html('');
        this.isSpinnerVisible = false;
      }
    }

    this.previousValue = this.searchField.val();
  }

  getResults() {
    $.when(
      $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()), 
      $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()))
      .then((posts, pages) => {
        const combinedResults = posts[0].concat(pages[0]);
        
        this.resultsDiv.html(`
          <h2 class="search-overlay__section-title">General Information</h2>
          ${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No results found.</p>'}
          ${combinedResults.map(item => {`<li><a href=${item.link}>${item.title.rendered}</a></li>`}).join('')}
          ${combinedResults.length ? '</ul>' : ''}
        `);

        this.isSpinnerVisible = false;
      }, 
      () => {
        // error handle for improper url
        this.resultsDiv.html('<p>Unexpected error; please try again.</p>');
      }
    );
  }

  addSearchHTML() {
    $('body').append(`
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" id="search-term" placeholder="what are you looking for?">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>

        <div class="container">
          <div id="search-overlay__results"></div>
        </div>
      </div>        
    `);
  }
}

export default Search;