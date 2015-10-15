<?php

class LoginView{
    
    private static $Username = 'LOGINVIEW::USERNAME';
    private static $Password = 'LOGINVIEW::PASSWORD';
    private static $Login = 'LOGINVIEW::LOGIN';
    
    public function response(){
        $name = $this->getUserName();
        
        $ret = 
        '
        <form method="post" action="">
                <div id="formheader">
                    Login
                </div id="formheader">
                <label for="'. self::$Username .'">Username :</label>
                <input type="text" id="'. self::$Username .'" name="'. self::$Username .'" value="'. $name .'">
                
                <label for="'. self::$Password .'">Password :</label>
                <input type="password" id="'. self::$Password .'" name="'. self::$Password .'">
                
                <input type="submit" name="'. self::$Login .'" value="Login">
        </form>
        ';
        
        return $ret;
    }
    
    public function doesUserWantToLogin(){
        return isset($_POST[self::$Login]);
    }
    
    public function getUsername(){
        if(!isset($_POST[self::$Username])){
            return '';
        }
        return $_POST[self::$Username];
    }
    
    public function getPassword(){
        return $_POST[self::$Password];
    }
}