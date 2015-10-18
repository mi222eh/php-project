<?php

class CreateToDoView{
    private static $task = 'CREATETODOVIEW::TASK';
    private static $details = 'CREATETODOVIEW::DETAILS';
    private static $create = 'CREATETODOVIEW::CREATE';


    public function response(){
        $ret = '';
        $ret .= $this->generateLinks();

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

    public function doesUserWantToCreate(){
        return isset($_POST[self::$create]);
    }

    public function getTask(){
        return $_POST[self::$task];
    }

    public function getDetails(){
        return $_POST[self::$details];
    }
}