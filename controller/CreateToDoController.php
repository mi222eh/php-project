<?php

class CreateToDoController{
    private $CreateToDoView;
    private $AddTaskModel;
    private $LoginModel;

    /**
     * @param CreateToDoView $createToDoView
     * @param LoginModel $loginModel
     * @param AddTaskModel $addNoteModel
     */
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

            if($this->AddTaskModel->addTaskToUser($this->LoginModel->getCurrentUser()->getName(), $Task, $Details)) {
                header("location: ?");
            }
        }
    }
}