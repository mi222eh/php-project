<?php

class RegisterController{
    private $RegisterView;
    private $RegisterModel;
    private $LoginModel;


    /**
     * @param RegisterView $RegisterView
     * @param RegisterModel $RegisterModel
     * @param LoginModel $loginModel
     */
    function __construct(RegisterView $RegisterView, RegisterModel $RegisterModel, LoginModel $loginModel){
        $this->RegisterView = $RegisterView;
        $this->RegisterModel = $RegisterModel;
        $this->LoginModel = $loginModel;
    }
    public function handleRegister(){
        if($this->RegisterView->didUserClickRegister()){
            $name = $this->RegisterView->getUserName();
            $password = $this->RegisterView->getPassword();
            $rePassword = $this->RegisterView->getRePassword();
            if($this->RegisterModel->register($name, $password, $rePassword)) {
                $this->LoginModel->setTempName($name);
                header("location: ?");
            }
        }
    }
}