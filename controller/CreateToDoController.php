<?php

class CreateToDoController{
    private $CreateToDoView;

    private $AddTaskModel;
    private $LoginModel;

    function __construct(CreateToDoView $createToDoView, LoginModel $loginModel, AddTaskModel $addNoteModel){
        $this->CreateToDoView = $createToDoView;
        $this->LoginModel = $loginModel;
        $this->AddTaskModel = $addNoteModel;
    }
    public function doCreate(){
        if($this->CreateToDoView->doesUserWantToCreate() &&
            $this->LoginModel->isLoggedIn()){

            $Task = $this->CreateToDoView->getTask();
            $Details = $this->CreateToDoView->getDetails();

            $this->AddTaskModel->addTaskToUser($this->LoginModel->getCurrentUser()->getName(), $Task, $Details);
            header("location: ?");
        }
    }
}