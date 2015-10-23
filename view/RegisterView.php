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
        $messages = array();
        if($this->RegisterModel->isPassWordsDontMatch()){
            $messages[] = 'Passwords do not match';
        }
        if($this->RegisterModel->isShortUsername()){
            $messages[] = 'Username must be at least three characters long';
        }
        if($this->RegisterModel->isShortPassword()) {
            $messages[] = 'Password must be at least six characters long';
        }
        if($this->RegisterModel->isUserAlreadyExist()){
            $messages[] = 'Username already exist';
        }
        if($this->RegisterModel->isUsernameHasInvalidCharacters()){
            $messages[] = 'Username has invalid characters';
        }

        $ret = $this->generateRegisterForm($messages);
        return $ret;
    }

    /**
     * @param array $messages
     * @return string
     */
    private function generateRegisterForm($messages){

        $messagesToRender = '';
        foreach ($messages as $message) {
            $messagesToRender .= $message . '<br>';
        }


        $ret =
            '
        <form method="post" action="" id="register">
                <div id="formheader">
                    Register
                </div>
                <p id="'. self::$Message .'">'. $messagesToRender .'</p>
                <label for="'. self::$Username .'">Username :</label>
                <input type="text" id="'. self::$Username .'" name="'. self::$Username .'" value="'. $this->RegisterModel->stripUsername($this->getUserName()) .'">

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
        if (isset($_POST[self::$Username])){
            return $_POST[self::$Username];
        }
        return '';
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