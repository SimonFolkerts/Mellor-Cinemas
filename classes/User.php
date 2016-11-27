<?php

class User {

    //SERVER-SIDE PROPERTIES
    
    private $id,
            $userName,
            $password,
            $email,
            $status;

    function getId() {
        return $this->id;
    }

    function getUserName() {
        return $this->userName;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    //CLIENT-SIDE PROPERTIES
    
    private $bookingCount;
   
    function getBookingCount() {
        return $this->bookingCount;
    }

    function setBookingCount($bookingCount) {
        $this->bookingCount = $bookingCount;
    }

}
