<?php

class RegisterModel{
    private $UserDAL;
    
    
    function __construct(){
        $this->UserDAL = new UserDAL();
    }
    
    public function register($name, $password){
        $user = new User($name, $password);
        $this->UserDAL->saveUserData($name, $user);
        var_dump($user);
        return true;
    }
    
    //<---------------------------------------------VALIDATION------------------------------------------>
}