<?php

class Account {

    private $con;
    private $errorArray = array();

    public function __construct($con) {
        $this->con = $con;
    }

    public function register($firstName, $lastName, $username, $email, $email2, $password, $password2) {
        $this->validateFirstName($firstName);  
        $this->validateLastName($lastName);  
        $this->validateUsername($username);  
        $this->validateEmails($email, $email2);  
        $this->validatePasswords($password, $password2);  

        if(empty($this->errorArray)) {
            return $this->insertUserDetails($firstName, $lastName, $username, $email, $password);
        } else {
            return false;
        }
    }

    public function insertUserDetails($firstName, $lastName, $username, $email, $password) {
        return true;
    }

    private function validateFirstName($firstName) {
        if(strlen($firstName) > 25 || strlen($firstName < 2)) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastName($lastName) {
        if(strlen($lastName) > 25 || strlen($lastName < 2)) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUsername($username) {
        if(strlen($username) > 25 || strlen($username < 5)) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $query = $this->con->prepare("SELECT username FROM users WHERE username = :username");
        $query->bindParam(":username", $username);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
        }
    }

    private function validateEmails($email, $email2) {
        if($email != $email2) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT email FROM users WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validatePasswords($password, $password2) {
        if($password != $password2) {
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
            return;
        }

        if(preg_match("/[^A-Za-z0-9]/", $password)) {
            array_push($this->errorArray, Constants::$passwordNotAlphaNumeric);
            return;
        }

        if(strlen($password) > 30 || strlen($password < 5)) {
            array_push($this->errorArray, Constants::$passwordLength);
        }

    }

    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }
}

?>