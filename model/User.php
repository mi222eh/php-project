<?php
class UsernameNotAStringException extends Exception{}
class PasswordNotAStringException extends Exception{}

class User{
    
    private $name;
    private $password;
    private $Notes = array();
    
    function __construct($name, $password){
        
        if(!is_string($name)){
            throw new UsernameNotAStringException();
        }
        
        if(!is_string($password)){
            throw new PasswordNotAStringException();
        }
        
        $this->name = $name;
        $this->password = $password;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getPassword(){
        return $this->password;
    }
}