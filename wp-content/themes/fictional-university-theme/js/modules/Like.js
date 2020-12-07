import $ from 'jquery';

class like {
  constructor() {
    this.events();
  }

  events() {
    $('.like-box').on('click', this.ourClickDispatcher.bind(this));
  }

  // methods
  ourClickDispatcher(e) {
    const currentLikeBox = $(e.target).closest('.like-box');

    if(currentLikeBox.data('exists') == 'yes') {
      this.deleteLike();
    } else {
      this.createLike();
    }
  }

  createLike() {
    console.log('nice');
  }

  deleteLike() {
    console.log('not nice');
  }
}

export default like;