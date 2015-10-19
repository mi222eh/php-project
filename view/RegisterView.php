<?php

class RegisterView{
    private static $Username = 'REGISTERVIEW::USERNAME';
    private static $Password = 'REGISTERVIEW::PASSWORD';
    private static $PasswordRepeat = 'REGISTERVIEW::PASSWORDREPEAT';
    private static $Message = 'REGISTERVIEW::MESSAGE';
    private static $Register = 'REGISTERVIEW::REGISTER';
    
    private $RegisterModel;

    /**
     * @param RegisterModel $RegisterModel
     */
    function __construct(RegisterModel $RegisterModel){
        $this->RegisterModel = $RegisterModel;
    }

    /**
     * @return string
     */
    public function response(){
        $ret = 
        '
        <form method="post" action="" id="register">
                <div id="formheader">
                    Register
                </div id="formheader">
                <p id="">
                <label for="'. self::$Username .'">Username :</label>
                <input type="text" id="'. self::$Username .'" name="'. self::$Username .'">
                
                <label for="'. self::$Password .'">Password :</label>
                <input type="password" id="'. self::$Password .'" name="'. self::$Password .'">
                
                <label for="'. self::$PasswordRepeat .'">Repeat Password :</label>
                <input type="password" id="'. self::$PasswordRepeat .'" name="'. self::$PasswordRepeat .'">
                
                <input type="submit" name="'. self::$Register .'" value="Register">
        </form>
        ';
        
        return $ret;
    }

    /**
     * @return bool
     */
    public function didUserClickRegister(){
        return isset($_POST[self::$Register]);
    }

    /**
     * @return String || NULL
     */
    public function getUserName(){
        return $_POST[self::$Username];
    }

    /**
     * @return String || NULL
     */
    public function getPassword(){
        return $_POST[self::$Password];
    }

    /**
     * @return String || NULL
     */
    public function getRePassword(){
        return $_POST[self::$PasswordRepeat];
    }
}