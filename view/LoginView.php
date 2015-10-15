<?php

class LoginView{
    
    private $LoginModel;
    
    private static $Username = 'LOGINVIEW::USERNAME';
    private static $Password = 'LOGINVIEW::PASSWORD';
    private static $Login = 'LOGINVIEW::LOGIN';
    private static $Logout = 'LOGINVIEW::LOGOUT';
    
    
    function __construct(LoginModel $LoginModel){
        $this->LoginModel = $LoginModel;
    }
    
    
    public function response(){
        if($this->LoginModel->isLoggedIn()){
            $user = $this->LoginModel->getCurrentUser();
            return '<div id="logout">
                        <p>Logged in as: '. $user->getName() .'</p>
                        <form method="post" action="">
                            <button type="submit" name="'.self::$Logout .'" value="logout">Logout</button>
                        </form>
                    </div>';
        }
        $name = $this->getUserName();
        
        $ret = 
        '
        <form method="post" action="" id="login">
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
    
    public function doesUserWantToLogout(){
        return isset($_POST['LOGINVIEW::LOGOUT']);
    }
}