<?php

class ContainerView{
    private $LoginView;
    private $RegisterView;
    private $NavigationView;
    
    function __construct(LoginView $LoginView, RegisterView $RegisterView, NavigationView $NavigationView){
        $this->LoginView = $LoginView;
        $this->RegisterView = $RegisterView;
        $this->NavigationView = $NavigationView;
    }
    
    public function response($isLoggedIn){
        if($this->NavigationView->doesUserWantToRegister()){
            return $this->RegisterView->response();
        }
        else{
            return $this->LoginView->response(); 
        }
        
    }
}