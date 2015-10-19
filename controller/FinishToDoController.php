<?php

class FinishToDoController{
    private $ToDoView;
    private $LoginModel;

    function __construct(ToDoView $toDoView, LoginModel $loginModel){
        $this->ToDoView = $toDoView;
        $this->LoginModel = $loginModel;
    }
    public function doFinish(){
        if($this->ToDoView->doesUserWantToFinish()){
            $id = $this->ToDoView->getFinishId();
            $user = $this->LoginModel->getCurrentUser();

            $user->finishTask($id);
            $this->LoginModel->saveCurrentUser();
            header("location: ?");
        }
        elseif($this->ToDoView->doesUserWantToUnFinish()){
            $id = $this->ToDoView->getUnfinishId();
            $user = $this->LoginModel->getCurrentUser();

            $user->unFinishTask($id);
            $this->LoginModel->saveCurrentUser();
            header("location: ?");
        }
    }
}