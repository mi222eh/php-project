<?php

class EditToDoController{
    private $LoginModel;
    private $ToDoView;
    private $CreateToDoView;

    function __construct(LoginModel $loginModel, ToDoView $toDoView, CreateToDoView $createToDoView){
        $this->LoginModel = $loginModel;
        $this->CreateToDoView = $createToDoView;
        $this->ToDoView = $toDoView;
    }

    public function doEdit(){
        if($this->ToDoView->doesUserWantToEdit()){
            $id = $this->ToDoView->getEditId($this->ToDoView->getEditId());
            $this->CreateToDoView->setEditId($id);
            $this->CreateToDoView->setEditMode(true);
        }
        if($this->CreateToDoView->doesUserWantToEdit()){
            $id = $this->CreateToDoView->getEditId();
            $title = $this->CreateToDoView->getTask();
            $details = $this->CreateToDoView->getDetails();
            $user = $this->LoginModel->getCurrentUser();
            $user->editTask($id, $title, $details);

            $this->LoginModel->saveCurrentUser();
            header("location: ?");
        }
    }
}