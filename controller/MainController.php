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
    private $DeleteToDoController;
    private $FinishToDoController;
    private $EditToDoController;
    
    function __construct(ContainerView $ContainerView, NavigationView $NavigationView,ToDoView $ToDoListView ,LoginController $LoginController, RegisterController $RegisterController, CreateToDoController $createToDoController, DeleteToDoController $deleteToDoController, FinishToDoController $finishToDoController, EditToDoController $editToDoController){
        $this->ContainerView = $ContainerView;
        $this->NavigationView = $NavigationView;
        $this->LoginController = $LoginController;
        $this->RegisterController = $RegisterController;
        $this->ToDoListView = $ToDoListView;
        $this->CreateToDoController = $createToDoController;
        $this->DeleteToDoController = $deleteToDoController;
        $this->FinishToDoController = $finishToDoController;
        $this->EditToDoController = $editToDoController;
    }
    public function handleInput(LoginModel $LoginModel){
        $this->LoginController->handleLogin();

        if($LoginModel->isLoggedIn()){
            if($this->ToDoListView->doesUserWantToCreate()){
                $this->CreateToDoController->doCreate();
            }
            elseif($this->ToDoListView->doesUserWantToDelete()){
                $this->DeleteToDoController->doDelete();
            }
            elseif($this->ToDoListView->doesUserWantToFinish()){
                $this->FinishToDoController->doFinish();
            }
            elseif($this->ToDoListView->doesUserWantToUnFinish()){
                $this->FinishToDoController->doFinish();
            }
            elseif($this->ToDoListView->doesUserWantToEdit()){
                $this->EditToDoController->doEdit();
            }
        }
        if($this->NavigationView->doesUserWantToRegister()){
            $this->RegisterController->handleRegister();
        }
    }
}