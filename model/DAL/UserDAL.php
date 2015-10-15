<?php

class UserDAL{
    private $dataDirectory;
    private $userDirectory;
    
    function __construct(){
        $this->dataDirectory = 'data';
        $this->userDirectory = 'users';
        
        //Create directories if they do not exist
        if(!file_exists($this->dataDirectory)){
            mkdir($this->dataDirectory, 0744);
        }
        if(!file_exists($this->dataDirectory . '/' . $this->userDirectory)){
            mkdir($this->dataDirectory . '/' . $this->userDirectory, 0744);
        }
    }
    
    //Returns a User
    public function GetUserData($name){
        $str = file_get_contents($this->dataDirectory . '/' . $this->userDirectory . '/' . $name);
        if ($str == null){
            return null;
        }
        $user = unserialize($str);
        return $user;
    }
    
    //Saves a User
    public function SaveUserData($name, $user){
        $str = serialize($user);
        file_put_contents($this->dataDirectory . '/'. $this->userDirectory . '/' . $name);
    }
}