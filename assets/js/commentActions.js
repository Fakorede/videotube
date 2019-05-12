function postComment(button, postedBy, videoId, replayTo, containerClass) {
  var textarea = $(button).siblings("textarea");
  // store value and clear textarea
  var commentText = textarea.val();
  textarea.val("");

  if (commentText) {
  } else {
    alert("cant post empty comment");
  }
}
