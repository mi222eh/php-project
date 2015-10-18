<?php

class MainController{
    //Views
    private $ContainerView;
    private $NavigationView;
    private $ToDoListView;

    //Controllers
    private $LoginController;
    private $RegisterController;
    private $CreateToDoController;
    
    function __construct(ContainerView $ContainerView, NavigationView $NavigationView,ToDoView $ToDoListView ,LoginController $LoginController, RegisterController $RegisterController, CreateToDoController $createToDoController){
        $this->ContainerView = $ContainerView;
        $this->NavigationView = $NavigationView;
        $this->LoginController = $LoginController;
        $this->RegisterController = $RegisterController;
        $this->ToDoListView = $ToDoListView;
        $this->CreateToDoController = $createToDoController;
    }
    public function handleInput(LoginModel $LoginModel){
        $this->LoginController->handleLogin();

        if($LoginModel->isLoggedIn()){
            if($this->ToDoListView->doesUserWantToCreate()){
                $this->CreateToDoController->doCreate();
            }
        }
        if($this->NavigationView->doesUserWantToRegister()){
            $this->RegisterController->handleRegister();
        }
    }
}