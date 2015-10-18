<?php
class NotAUserException extends Exception{}
class AddTaskModel{
    private $UserDAL;

    function __construct(){
        $this->UserDAL = new UserDAL();
    }

    public function addTaskToUser($name, $task, $details){
        $user = $this->UserDAL->getUserData($name);
        if(!($user instanceof User)) {
            throw new NotAUserException();
        }
        $user->addNote($task, $details);
        $this->UserDAL->saveUserData($user->getName(), $user);
    }

}