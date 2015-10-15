<?php

class MainController{
    private $ContainerView;
    private $NavigationView;
    private $LoginController;
    private $RegisterController;
    
    function __construct(ContainerView $ContainerView, NavigationView $NavigationView, LoginController $LoginController, RegisterController $RegisterController){
        $this->ContainerView = $ContainerView;
        $this->NavigationView = $NavigationView;
        $this->LoginController = $LoginController;
        $this->RegisterController = $RegisterController;
    }
    public function handleInput(LoginModel $LoginModel){
        if($this->NavigationView->doesUserWantToRegister()){
            $this->RegisterController->handleRegister();
        }
        else{
            $this->LoginController->handleLogin();
        }
    }
}