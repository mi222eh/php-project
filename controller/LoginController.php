<?php

class LoginController{
    private $LoginView;
    private $LoginModel;
    
    
    function __construct(LoginView $LoginView, LoginModel $LoginModel){
        $this->LoginView = $LoginView;
        $this->LoginModel = $LoginModel;
    }
    
    public function handleLogin(){
        if($this->LoginView->doesUserWantToLogin()){
            $name = $this->LoginView->getUsername();
            $password  = $this->LoginView->getPassword();
            
            if($this->LoginModel->login($name, $password)){
                header("location: ?");
            }
        }
        elseif($this->LoginView->doesUserWantToLogout()){
            $this->LoginModel->logout();
            header("location: ?");
        }
    }
}