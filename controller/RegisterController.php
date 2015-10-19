<?php

class RegisterController{
    private $RegisterView;
    private $RegisterModel;
    
    
    function __construct(RegisterView $RegisterView, RegisterModel $RegisterModel){
        $this->RegisterView = $RegisterView;
        $this->RegisterModel = $RegisterModel;
    }
    public function handleRegister(){
        if($this->RegisterView->didUserClickRegister()){
            $name = $this->RegisterView->getUserName();
            $password = $this->RegisterView->getPassword();
            $repassword = $this->RegisterView->getRePassword();
            if($this->RegisterModel->register($name, $password)){
                header("location: ?");
            }
            
        }
    }
}