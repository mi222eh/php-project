<?php

class PasswordModel{
    private $salt;
    
    function __construct(){
        $this->salt = '45hf3ojdsfhg49gfsd5464dfgs45';
    }
    /**
     * @param $password
     * @return string
     */
    function hashPassword($password){
        $password .= $this->salt;
        $hash = sha1($password);
        return $hash;
    }
    /**
     * @param $hashedPassword
     * @param $password
     * @return bool
     */
    function compare($hashedPassword, $password){
        $password .= $this->salt;
        $hash = sha1($password);
        return ($hash == $hashedPassword);
    }
}