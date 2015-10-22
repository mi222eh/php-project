<?php

class EditToDoController{
    private $LoginModel;
    private $ToDoView;
    private $CreateToDoView;
    private $AddTaskModel;

    /**
     * @param LoginModel $loginModel
     * @param ToDoView $toDoView
     * @param CreateToDoView $createToDoView
     * @param AddTaskModel $addTaskModel
     */
    function __construct(LoginModel $loginModel, ToDoView $toDoView, CreateToDoView $createToDoView, AddTaskModel $addTaskModel){
        $this->LoginModel = $loginModel;
        $this->CreateToDoView = $createToDoView;
        $this->ToDoView = $toDoView;
        $this->AddTaskModel = $addTaskModel;
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
            if($this->AddTaskModel->editTaskToUser($user, $title, $details, $id)){
                $this->LoginModel->saveCurrentUser();
                header("location: ?");
            }
        }
    }
}