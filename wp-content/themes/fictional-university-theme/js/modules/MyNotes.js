import $ from 'jquery';

class MyNotes {
  constructor() {
    this.events();
  }

  events() {
    $('.delete-note').on('click', this.deleteNote)
  }


  // methods
  deleteNote() {
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
      },
      url: universityData.root_url + `/wp-json/wp/v2/note/82`,
      type: 'DELETE',
      success: () => {
        console.log('nice');
        console.log(response);
      },
      error: () => {
        console.log('nope'),
        console.log(response);
      }
    })
  }
}

export default MyNotes;