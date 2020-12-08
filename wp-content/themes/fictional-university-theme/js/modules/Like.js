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

    // to pull in live data (no refresh, use .attr)
    if(currentLikeBox.attr('data-exists') == 'yes') {
      this.deleteLike(currentLikeBox);
    } else {
      this.createLike(currentLikeBox);
    }
  }

  createLike(currentLikeBox) {
    $.ajax({
      // required nonce for wordpress api
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
      },
      url: universityData.root_url + '/wp-json/university/v1/manageLike',
      type: 'POST',
      data: { 'professorId': currentLikeBox.data('professor') },
      success: (response) => {
        currentLikeBox.attr('data-exists', 'yes');
        let likeCount = parseInt(currentLikeBox.find('.like-count').html(), 10);

        likeCount++;
        currentLikeBox.find('.like-count').html(likeCount);
        currentLikeBox.attr('data-like', response);
      },
      error: (response) => {
        console.log(response);
      }
    });
  }

  deleteLike(currentLikeBox) {
    $.ajax({
      // required nonce for wordpress api
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
      },
      url: universityData.root_url + '/wp-json/university/v1/manageLike',
      data: { 'like': currentLikeBox.attr('data-like') },
      type: 'DELETE',
      success: (response) => {
        currentLikeBox.attr('data-exists', 'no');
        let likeCount = parseInt(currentLikeBox.find('.like-count').html(), 10);

        likeCount--;
        currentLikeBox.find('.like-count').html(likeCount);
        currentLikeBox.attr('data-like', '');
      },
      error: (response) => {
        console.log(response);
      }
    });
  }
}

export default like;