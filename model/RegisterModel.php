<?php

class RegisterModel{
    private $UserDAL;
    private $passwordModel;

    private $userAlreadyExist = false;
    private $passWordsDontMatch = false;
    private $shortUsername = false;
    private $shortPassword = false;
    private $usernameHasInvalidCharacters = false;

    /**
     * @return boolean
     */
    public function isUserAlreadyExist()
    {
        return $this->userAlreadyExist;
    }

    /**
     * @return boolean
     */
    public function isPassWordsDontMatch()
    {
        return $this->passWordsDontMatch;
    }

    /**
     * @return boolean
     */
    public function isUsernameHasInvalidCharacters()
    {
        return $this->usernameHasInvalidCharacters;
    }

    /**
     * @return boolean
     */
    public function isShortPassword()
    {
        return $this->shortPassword;
    }

    /**
     * @return boolean
     */
    public function isShortUsername()
    {
        return $this->shortUsername;
    }


    /**
     *
     */
    function __construct(){
        $this->UserDAL = new UserDAL();
        $this->passwordModel = new PasswordModel();
    }

    /**
     * @param $name
     * @param $password
     * @param $rePassword
     * @return bool
     */
    public function register($name, $password, $rePassword){
        $canRegister = true;

        if(!$this->validateUsername($name)){
            $canRegister = false;
            $this->shortUsername = true;
        }
        if(!$this->validatePassword($password)){
            $canRegister = false;
            $this->shortPassword = true;
        }
        if(!$this->validateRepeatPassword($password, $rePassword)){
            $canRegister = false;
            $this->passWordsDontMatch = true;
        }
        if($canRegister){

            if($this->doesUsernameContainInvalidCharacters($name)){
                $canRegister = false;
                $this->usernameHasInvalidCharacters = true;
            }
            elseif($this->userAlreadyExist($name)){
                $canRegister = false;
                $this->userAlreadyExist = true;
            }
            if($canRegister){
                $user = new User($name, $this->passwordModel->hashPassword($password));
                $this->UserDAL->saveUserData($name, $user);
            }
        }
        return $canRegister;
    }

    /**
     * @param $username
     * @return string
     */
    public function stripUsername($username){
        return strip_tags($username);
    }
    
    //<---------------------------------------------VALIDATION------------------------------------------>
    /**
     * @param $name
     * @return bool
     */
    private function userAlreadyExist($name){
        $user = $this->UserDAL->getUserData($name);
        return ($user!=null);
    }

    /**
     * @param $name
     * @return bool
     */
    private function validateUsername($name){
        return (mb_strlen($name, "UTF-8") >= 3);
    }

    /**
     * @param $password
     * @return bool
     */
    private function validatePassword($password){
        return (mb_strlen($password, "UTF-8") >= 6);
    }

    /**
     * @param $password
     * @param $rePassword
     * @return bool
     */
    private function validateRepeatPassword($password, $rePassword){
        return ($password == $rePassword);
    }

    /**
     * @param $username
     * @return bool
     */
    private function doesUsernameContainInvalidCharacters($username){
        return (strip_tags($username) != $username);
    }




}