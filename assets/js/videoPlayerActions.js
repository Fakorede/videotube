function likeVideo(button, videoId) {
  $.post("ajax/likeVideo.php", { videoId: videoId }).done(function(data) {
    // update button
    var likeButton = $(button);
    var dislikeButton = $(button).siblings(".dislikeButton");

    likeButton.addClass("active");
    dislikeButton.removeClass("active");
  });
}
