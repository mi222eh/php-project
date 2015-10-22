<?php

class DeleteToDoController{
    private $ToDoView;
    private $LoginModel;

    /**
     * @param ToDoView $toDoView
     * @param LoginModel $loginModel
     */
    function __construct(ToDoView $toDoView, LoginModel $loginModel){
        $this->ToDoView = $toDoView;
        $this->LoginModel = $loginModel;
    }


    public function doDelete(){
        if($this->ToDoView->doesUserWantToDelete()){
            $id = $this->ToDoView->getDeleteId();
            $user = $this->LoginModel->getCurrentUser();
            $user->deleteTask($id);
            $this->LoginModel->saveCurrentUser();
            header("location: ?");
        }
    }
}