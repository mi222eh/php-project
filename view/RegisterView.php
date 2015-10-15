<?php

class RegisterView{
    private static $Username = 'REGISTERVIEW::USERNAME';
    private static $Password = 'REGISTERVIEW::PASSWORD';
    private static $PasswordRepeat = 'REGISTERVIEW::PASSWORDREPEAT';
    private static $Message = 'REGISTERVIEW::MESSAGE';
    private static $Register = 'REGISTERVIEW::REGISTER';
    
    private $RegisterModel;
    
    function __construct(RegisterModel $RegisterModel){
        $this->RegisterModel = $RegisterModel;
    }
    
    public function response(){
        $ret = 
        '
        <form method="post" action="">
                <div id="formheader">
                    Register
                </div id="formheader">
                <p id="">
                <label for="'. self::$Username .'">Username :</label>
                <input type="text" id="'. self::$Username .'" name="'. self::$Username .'">
                
                <label for="'. self::$Password .'">Password :</label>
                <input type="password" id="'. self::$Password .'" name="'. self::$Password .'">
                
                <label for="'. self::$Password .'">Repeat Password :</label>
                <input type="password" id="'. self::$Password .'" name="'. self::$Password .'">
                
                <input type="submit" name="'. self::$Register .'" value="Register">
        </form>
        ';
        
        return $ret;
    }
    
    public function didUserClickRegister(){
        return isset($_POST[self::$Register]);
    }
    
    public function getUserName(){
        return $_POST[self::$Username];
    }
    
    public function getPassword(){
        return $_POST[self::$Username];
    }
}