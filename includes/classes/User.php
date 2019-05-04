<?php

class User {

    private $con, $sqlData;

    public function __construct($con, $username) {
        
        $this->con = $con;

    }
}

?>