<?php

class LoginView{
    
    private $LoginModel;
    
    private static $Username = 'LOGINVIEW::USERNAME';
    private static $Password = 'LOGINVIEW::PASSWORD';
    private static $Login = 'LOGINVIEW::LOGIN';
    private static $Logout = 'LOGINVIEW::LOGOUT';
    private static $Message = 'LOGINVIEW::MESSAGE';


    /**
     * @param LoginModel $LoginModel
     */
    function __construct(LoginModel $LoginModel){
        $this->LoginModel = $LoginModel;
    }


    /**
     * @return string
     */
    public function response(){
        if($this->LoginModel->isLoggedIn()) {
            $user = $this->LoginModel->getCurrentUser();
            return $this->generateLogout($user);

        }
        else{
            $messages = array();

            if($this->LoginModel->isEmptyUsername()){
                $messages[] = 'Username is empty';
            }
            if($this->LoginModel->isEmptyPassword()){
                $messages[] = 'Password is empty';
            }
            if($this->LoginModel->isFailedLogin()){
                $messages[] = 'Wrong login information';
            }

            return $this->generateLogin($messages);
        }
    }

    /**
     * @param $user
     * @return string
     */
    private function generateLogout($user){
        return '<div id="logout">
                        <p>Logged in as: '. $user->getName() .'</p>
                        <form method="post" action="">
                            <button type="submit" name="'.self::$Logout .'" value="logout">Logout</button>
                        </form>
                    </div>';
    }

    /**
     * @param array $messages
     * @return string
     */
    private function generateLogin($messages){

        $messagesToRender = '';
        foreach ($messages as $message) {
            $messagesToRender .= $message . '<br>';
        }


        $name = $this->LoginModel->getTempName();
        if(empty($name)){
            $name = $this->getUsername();
        }
        else{
            $messagesToRender = 'Username registered';
        }
        $ret =
            '
        <form method="post" action="" id="login">
                <div id="formheader">
                    Login
                </div id="formheader">
                <p id="'. self::$Message .'">'. $messagesToRender .'</p>
                <label for="'. self::$Username .'">Username :</label>
                <input type="text" id="'. self::$Username .'" name="'. self::$Username .'" value="'. $name .'">

                <label for="'. self::$Password .'">Password :</label>
                <input type="password" id="'. self::$Password .'" name="'. self::$Password .'">

                <input type="submit" name="'. self::$Login .'" value="Login">
        </form>
        ';

        return $ret;
    }

    /**
     * @return bool
     */
    public function doesUserWantToLogin(){
        return isset($_POST[self::$Login]);
    }

    /**
     * @return String
     */
    public function getUsername(){
        if(!isset($_POST[self::$Username])){
            return '';
        }
        return $_POST[self::$Username];
    }

    /**
     * @return String || NULL
     */
    public function getPassword(){
        return $_POST[self::$Password];
    }

    /**
     * @return bool
     */
    public function doesUserWantToLogout(){
        return isset($_POST['LOGINVIEW::LOGOUT']);
    }
}