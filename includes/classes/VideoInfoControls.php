<?php

require_once("includes/classes/ButtonProvider.php");
class VideoInfoControls {

    private $video, $userLoggedInObj;

    public function __construct($video, $userLoggedInObj) {
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {

        $likeButton = $this->createLikeButton();
        $dislikeButton = $this->createDislikeButton();

        return "
            <div class='controls'>
                $likeButton
                $dislikeButton
            </div>
        ";
    }

    private function createLikeButton() {
        $text = $this->video->getLikes();
        $videoId = $this->video->getId();
        $action = "likeVideo(this, $videoId)";
        $class = "LikeButton";

        $imageSrc = "assets/images/icons/thumb-up.png";

        // change button img if video has already been liked

        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }

    private function createDislikeButton() {
        return "
            <button>Dislike</button>
        ";
    }
}

?>