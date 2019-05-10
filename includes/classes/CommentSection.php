<?php

require_once("includes/classes/ButtonProvider.php");

class CommentSection {

    private $con, $video, $userLoggedInObj;

    public function __construct($con, $video, $userLoggedInObj) {
        $this->con = $con;
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {
        return $this->createCommentSection();
    }

    private function createCommentSection() {
        $numComments = $this->video->getNumberOfComments();
        $postedBy = $this->userLoggedInObj->getUsername();
        $videoId = $this->video->getId();

        $profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);

        $commentAction = "postComment(this, \"$postedBy\", $videoId, null, \"comments\")";
        $commentButton = ButtonProvider::createButton("COMMENT", null, $commentAction, "postComment");

        // comment form
        return "
            <div class='commentSection'>

                <div class='header'>
                    <span class='commentCount'>$numComments comments</span>

                    <div class='commentForm'>
                        $profileButton
                        <textarea class='commentBodyClass' placeholder='Add a comment'></textarea>
                        $commentButton
                    </div>
                </div>

                <div class='comments'>

                </div>

            </div>
        ";
    }

    

}

?>