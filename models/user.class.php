<?php
//Matthew Carter
//I211
//This just builds the user class, feel free to add whatever you want as far as data.
class User {
     
    private $id, $username, $first_name, $last_name, $email, $password, $role;
    
    public function __construct($username, $first_name, $last_name, $email, $password, $role) {
        
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
    
    public function getId() {
        return $this->id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getFirstName() {
        return $this->first_name;
    }
    public function getLastName() {
        return $this->last_name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getRole() {
        return $this->role;
    }
    public function setId($id) {
        $this->id = $id;
    }

}
