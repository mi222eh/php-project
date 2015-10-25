<?php

class LoginModel{
    //ID for session
    private static $LoginSessionString = 'SESSION:LOGIN';
    private static $LoginTempName = 'SESSION:TEMPNAME';
    
    private $UserDAL;
    private $passwordModel;
    private $UserSession;
    private $IsLoggedIn;
    
    private $CurrentUser;

    //VALIDATION
    private $emptyUsername = false;
    private $emptyPassword = false;
    private $failedLogin = false;

    /**
     *
     */
    function __construct(){
        $this->UserDAL = new UserDAL();
        $this->UserSession = new UserSession();
        $this->passwordModel = new PasswordModel();
        
        $this->IsLoggedIn = $this->UserSession->isSessionSet(self::$LoginSessionString);
        if($this->IsLoggedIn){
            $this->CurrentUser = $this->UserDAL->getUserData($this->UserSession->getSession(self::$LoginSessionString));
        }
    }

    /**
     * @return bool
     */
    public function isLoggedIn(){
        return $this->IsLoggedIn;
    }

    /**
     * @param $name
     * @param $password
     * @return bool
     */
    public function login($name, $password){
        $canLogin = true;

        if(empty($name)){
            $canLogin = false;
            $this->emptyUsername = true;
        }
        if(empty($password)){
            $canLogin = false;
            $this->emptyPassword = true;
        }
        if($canLogin){
            $user = $this->UserDAL->getUserData($name);
            if(empty($user)){
                $canLogin = false;
                $this->failedLogin = true;
            }
            else{
                if($this->passwordModel->compare($user->getPassword(), $password)){
                    $this->setSession($name);
                }
                else{
                    $canLogin = false;
                    $this->failedLogin = true;
                }
            }
        }
        return $canLogin;
    }

    /**
     *
     */
    public function saveCurrentUser(){
        $this->UserDAL->saveUserData($this->CurrentUser->getName(), $this->CurrentUser);
    }

    /**
     *
     */
    public function logout(){
        $this->removeSession();
    }
    

    /**
     * @return User|null
     */
    public function getCurrentUser(){
        return $this->CurrentUser;
    }

    /**
     * @return null
     */
    public function getTempName(){
        $name = $this->UserSession->getSession(self::$LoginTempName);
        $this->UserSession->removeSession(self::$LoginTempName);
        return $name;
    }

    /**
     * @param $name
     */
    public function setTempName($name){
        $this->UserSession->setSession(self::$LoginTempName, $name);
    }

    /**
     * @param $name
     */
    private function setSession($name){
        $this->UserSession->setSession(self::$LoginSessionString, $name);
    }

    /**
     *
     */
    private function removeSession(){
        $this->UserSession->removeSession(self::$LoginSessionString);
    }

    /**
     * @return boolean
     */
    public function isEmptyUsername()
    {
        return $this->emptyUsername;
    }

    /**
     * @return boolean
     */
    public function isEmptyPassword()
    {
        return $this->emptyPassword;
    }

    /**
     * @return boolean
     */
    public function isFailedLogin()
    {
        return $this->failedLogin;
    }
}