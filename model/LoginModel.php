<?php

class LoginModel{
    //ID for session
    private static $LoginSessionString = 'SESSION:LOGIN';
    
    private $UserDAL;
    private $UserSession;
    private $IsLoggedIn;
    
    private $CurrentUser;
    
    //TEMPORARY DATA
    private $admin;
    
    function __construct(){
        $this->UserDAL = new UserDAL();
        $this->UserSession = new UserSession();
        $this->admin = new User("admin", "password");
        
        $this->IsLoggedIn = $this->UserSession->isSessionSet(self::$LoginSessionString);
        if($this->IsLoggedIn){
            $this->CurrentUser = $this->UserDAL->getUserData($this->UserSession->getSession(self::$LoginSessionString));
        }
    }
    
    public function isLoggedIn(){
        return $this->IsLoggedIn;
    }
    
    public function login($name, $password){
        
        $user = $this->UserDAL->getUserData($name);
        if(empty($user)){
            return false;
        }
        
        elseif(($this->admin->getName() == $name && $this->admin->getPassword() == $password) || $user->getPassword() == $password){
            $this->setSession($name);
            return true;
        }
        else{
            return false;
        }
    }
    
    public function logout(){
        $this->removeSession();
    }
    
    //Returns current user
    public function getCurrentUser(){
        return $this->CurrentUser;
    }
    
    public function getTempName(){
        
    }
    
    private function setSession($name){
        $this->UserSession->setSession(self::$LoginSessionString, $name);
    }
    
    private function removeSession(){
        $this->UserSession->removeSession(self::$LoginSessionString);
    }
}