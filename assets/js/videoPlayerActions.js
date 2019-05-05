function likeVideo(button, videoId) {
  $.post("ajax/likeVideo.php", { videoId: videoId }).done(function(data) {
    // update button
    var likeButton = $(button);
    var dislikeButton = $(button).siblings(".dislikeButton");

    likeButton.addClass("active");
    dislikeButton.removeClass("active");

    // parse returned string to json object
    var result = JSON.parse(data);

    // update values
    updateLikesValue(likeButton.find(".text"), result.likes);
    updateLikesValue(dislikeButton.find(".text"), result.dislikes);
  });
}

function updateLikesValue(element, num) {
  var likesCountVal = element.text() || 0;
  element.text(parseInt(likesCountVal) + parseInt(num));
}
