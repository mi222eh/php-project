<?php

class UserSession{
    
    function __construct(){
        session_start();
    }
    
    public function setSession($id, $value){
        $_SESSION[$id] = $value;
    }
    
    public function isSessionSet($id){
        return isset($_SESSION[$id]);
    }
    
    public function removeSession($id){
        unset($_SESSION[$id]);
    }
    
    public function getSession($id){
        return $_SESSION[$id];
    }
}