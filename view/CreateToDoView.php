<?php

class CreateToDoView{
    private static $task = 'CREATETODOVIEW::TASK';
    private static $details = 'CREATETODOVIEW::DETAILS';
    private static $create = 'CREATETODOVIEW::CREATE';
    private static $edit = 'CREATETODOVIEW::EDIT';

    private $LoginModel;

    private $editMode = false;
    private $editId;

    function __construct(LoginModel $loginModel){
        $this->LoginModel = $loginModel;
    }

    public function response(){
        $ret = '';
        $ret .= $this->generateLinks();
        if($this->editMode){
            $ret .= $this->generateEditToDo();
        }
        else{
            $ret .= $this->generateCreateToDo();
        }
        return $ret;
    }

    private function generateEditToDo(){

        $user = $this->LoginModel->getCurrentUser();
        var_dump($this->editId);

        $task = $user->getTaskById($this->editId);


        $ret = '';
        $ret .= '<form method="post" action="" id="create">
                    <div id="formheader">
                        <p>Edit task</p>
                    </div>
                    <lable for="'. self::$task .'">Task:</lable>
                    <input type="text" id="'. self::$task .'" name="'. self::$task .'" value="'. $task->getTitle() .'">

                    <lable for="'. self::$details .'">Details:</lable>
                    <textarea id="'. self::$details.'" name="'. self::$details .'" >'.$task->getDetails().'</textarea>

                    <input type="submit" value="Edit" name="'. self::$edit .'">
                 </form>';

        return $ret;
    }

    private function generateCreateToDo(){
        $ret = '';
        $ret .= '<form method="post" action="" id="create">
                    <div id="formheader">
                        <p>New Task</p>
                    </div>
                    <lable for="'. self::$task .'">Task:</lable>
                    <input type="text" id="'. self::$task .'" name="'. self::$task .'">

                    <lable for="'. self::$details .'">Details:</lable>
                    <textarea id="'. self::$details.'" name="'. self::$details .'"></textarea>

                    <input type="submit" value="Add" name="'. self::$create .'">
                 </form>';

        return $ret;
    }

    private function generateLinks(){
        $ret = '';

        $ret .= '<div id="menu">
                    <ul>
                        <li><a href="?">Back</a></li>
                    </ul>
                </div>';

        return $ret;
    }

    public function setEditMode($editMode){
        $this->editMode = $editMode;
    }

    public function doesUserWantToCreate(){
        return isset($_POST[self::$create]);
    }

    public function getTask(){
        return $_POST[self::$task];
    }

    public function getDetails(){
        return $_POST[self::$details];
    }

    public function doesUserWantToEdit(){
        return isset($_POST[self::$edit]);
    }

    public function setEditId($id){
        $this->editId = $id;
    }

    public function getEditId(){
        return $this->editId;
    }
}