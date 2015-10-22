<?php
class NotAUserException extends Exception{}
class AddTaskModel{
    private $UserDAL;
    
    //Validation
    private $titleEmpty = false;
    private $failedAttempt = false;

    /**
     * @return boolean
     */
    public function isFailedAttempt()
    {
        return $this->failedAttempt;
    }

    /**
     * @return boolean
     */
    public function isTitleEmpty()
    {
        return $this->titleEmpty;
    }


    /**
     *
     */
    function __construct(){
        $this->UserDAL = new UserDAL();
    }

    /**
     * @param $name
     * @param $task
     * @param $details
     * @return bool
     */
    public function addTaskToUser($name, $task, $details){
        $task = strip_tags($task);
        $details = strip_tags($details);

        $user = $this->UserDAL->getUserData($name);
        $canAdd = true;
        if(!$this->validateTitle($task)){
            $this->titleEmpty = true;
            $canAdd = false;
        }
        if($canAdd){
            $user->addNote($task, $details);
            $this->UserDAL->saveUserData($user->getName(), $user);
        }
        $this->failedAttempt = !$canAdd;
        return $canAdd;
    }

    /**
     * @param $user
     * @param $task
     * @param $details
     * @param $id
     * @return bool
     */
    public function editTaskToUser($user, $task, $details, $id){
        $task = strip_tags($task);
        $details = strip_tags($details);

        $canEdit = true;
        if(!$this->validateTitle($task)){
            $this->titleEmpty = true;
            $canEdit = false;
        }
        if($canEdit){
            $user->editTask($id, $task, $details);
            $this->UserDAL->saveUserData($user->getName(), $user);
        }
        $this->failedAttempt = !$canEdit;
        return $canEdit;
    }

    //<-----------------------------------Validation----------------------------------->
    /**
     * @param $title
     * @return bool
     */
    private function validateTitle($title){
        return (mb_strlen($title, "UTF-8") > 0);
    }


}