<?php 

class Video {

    private $con, $sqlData, $userLoggedInObj;

    // $input reps sql data or an id
    public function __construct($con, $input, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;

        if(is_array($input)) {
            $this->sqlData = $input;
        } else {
            // $input is an id
            $query = $this->con->prepare("SELECT * FROM videos WHERE id = :id");
            $query->bindParam(":id", $input);
            $query->execute();
            
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }
    }

}


?>