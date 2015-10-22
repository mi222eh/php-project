<?php

class CreateToDoView{
    private static $task = 'CREATETODOVIEW::TASK';
    private static $details = 'CREATETODOVIEW::DETAILS';
    private static $create = 'CREATETODOVIEW::CREATE';
    private static $edit = 'CREATETODOVIEW::EDIT';
    private static $message = 'CREATETODOVIEW::MESSAGE';

    private $LoginModel;
    private $AddTaskModel;

    private $editMode = false;
    private $editId;

    /**
     * @param LoginModel $loginModel
     * @param AddTaskModel $addTaskModel
     */
    function __construct(LoginModel $loginModel, AddTaskModel $addTaskModel){
        $this->LoginModel = $loginModel;
        $this->AddTaskModel = $addTaskModel;
    }

    /**
     * @return string
     */
    public function response(){
        $messages = array();
        if($this->AddTaskModel->isTitleEmpty()){
            $messages[] = 'Title cannot be empty';
        }
        $ret = '';
        $ret .= $this->generateLinks();
        if($this->editMode){
            $ret .= $this->generateEditToDo($messages);
        }
        else{
            $ret .= $this->generateCreateToDo($messages);
        }
        return $ret;
    }

    /**
     * @param array $messages
     * @return string
     */
    private function generateEditToDo($messages){

        $messagesToRender = '';
        $user = $this->LoginModel->getCurrentUser();
        $task = $user->getTaskById($this->editId);

        if(empty($task)){
            return '<p class="center">Could not find task</p>';
        }
        $title = '';
        $details = '';
        foreach ($messages as $message) {
            $messagesToRender .= $message;
        }
        var_dump($this->AddTaskModel->isFailedAttempt());
        if($this->AddTaskModel->isFailedAttempt()){
            $title = $this->getTask();
            $details = $this->getDetails();

        }
        else{
            $title = $task->getTitle();
            $details = $task->getDetails();
        }


        $ret = '';
        $ret .= '<form method="post" action="" id="create">
                    <div id="formheader">
                        <p>Edit task</p>
                    </div>
                    <p id="'. self::$message .'">'. $messagesToRender .'</p>
                    <lable for="'. self::$task .'">Task:</lable>
                    <input type="text" id="'. self::$task .'" name="'. self::$task .'" value="'. $title .'">

                    <lable for="'. self::$details .'">Details:</lable>
                    <textarea id="'. self::$details.'" name="'. self::$details .'" >'.$details.'</textarea>

                    <input type="submit" value="Edit" name="'. self::$edit .'">
                 </form>';

        return $ret;
    }

    /**
     * @param array $messages
     * @return string
     */
    private function generateCreateToDo($messages){
        $messagesToRender = '';

        foreach ($messages as $message) {
            $messagesToRender .= $message;
        }

        $title = $this->getTask();
        $details = $this->getDetails();

        $ret = '';
        $ret .= '<form method="post" action="" id="create">
                    <div id="formheader">
                        <p>New Task</p>
                    </div>
                    <p id="'. self::$message .'">'. $messagesToRender .'</p>
                    <lable for="'. self::$task .'">Task:</lable>
                    <input type="text" id="'. self::$task .'" name="'. self::$task .'" value="'. $title .'">

                    <lable for="'. self::$details .'">Details:</lable>
                    <textarea id="'. self::$details.'" name="'. self::$details .'">'. $details .'</textarea>

                    <input type="submit" value="Add" name="'. self::$create .'">
                 </form>';

        return $ret;
    }

    /**
     * @return string
     */
    private function generateLinks(){
        $ret = '';

        $ret .= '<div id="menu">
                    <ul>
                        <li><a href="?">Back</a></li>
                    </ul>
                </div>';

        return $ret;
    }

    /**
     * @param $editMode
     */
    public function setEditMode($editMode){
        $this->editMode = $editMode;
    }

    /**
     * @return bool
     */
    public function doesUserWantToCreate(){
        return isset($_POST[self::$create]);
    }

    /**
     * @return string
     */
    public function getTask(){
        if(isset($_POST[self::$task])){
            return $_POST[self::$task];
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDetails(){
        if(isset($_POST[self::$details])){
            return $_POST[self::$details];
        }
        return '';
    }

    /**
     * @return bool
     */
    public function doesUserWantToEdit(){
        return isset($_POST[self::$edit]);
    }

    /**
     * @param $id
     */
    public function setEditId($id){
        $this->editId = $id;
    }

    /**
     * @return mixed
     */
    public function getEditId(){
        return $this->editId;
    }
}