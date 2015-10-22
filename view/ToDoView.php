<?php

class ToDoView{
    private static $Create = 'Create';
    private static $Edit = 'Edit';
    private static $Delete = 'Delete';
    private static $Task = 'Task';
    private static $Finish = 'Finish';
    private static $Unfinish = 'Unfinish';
    private $LoginModel;

    /**
     * @param LoginModel $LoginModel
     */
    function __construct(LoginModel $LoginModel){
        $this->LoginModel = $LoginModel;
    }

    /**
     * @return string
     */
    public function response(){
        $ret = '';
        $ret .= $this->generateMenu();
        if($this->doesUserWantToWatchTask()){
            $ret .= $this->generateBackButton();
            $ret .= $this->generateTask();

        }
        else{
            $ret .= $this->generateToDoList();
            $ret .= '<div style="clear:both"></div>';
        }

        return $ret;
    }

    /**
     * @return string
     */
    private function generateMenu(){
        return '<div id="menu">
                    <ul>
                        <li><a href="?'.self::$Create.'">New task</a></li>
                    </ul>
                </div>';
    }

    /**
     * @return string
     */
    private function generateToDoList(){
        $user = $this->LoginModel->getCurrentUser();
        $tasks = $user->getTasks();
        return $this->generateList($tasks);

    }


    /**
     * @param <array>Task $tasks
     * @return string
     */
    private function generateList($tasks){
        $ret = '';
        $ret .= '<div id="tasks">
                    <div id="left">
                        <div class="listTitle">
                            <p>Unfinished</p>
                        </div>
                        <ul>';
        $ret .= $this->generateTasks($tasks, false);
        $ret .= '       </ul>
                    </div>';

        $ret .= '   <div id="right">
                        <div class="listTitle">
                            <p>Finished</p>
                        </div>
                        <ul>';
        $ret .= $this->generateTasks($tasks, true);
        $ret .= '       </ul>
                    </div>
                </div>';

        return $ret;
    }

    /**
     * @param $tasks
     * @param $isFinished
     * @return string
     */
    private function generateTasks($tasks, $isFinished){
        $ret = '';
        foreach ($tasks as $task) {

            if($task->IsTaskFinished() == $isFinished){
                $ret .= '<li class="task">';
                $ret .= '<div class="taskTitle">';
                $ret .= '<a href="?'. self::$Task .'='. $task->getId() .'">';
                $ret .= $task->getTitle();
                $ret .= '</a>';
                $ret .= '</div>';
                $ret .= $this->generateLinksForTask($task->getId(), $task->IsTaskFinished());
                $ret .= '</li>';
            }
        }

        return $ret;
    }

    /**
     * @return string
     */
    private function generateBackButton(){
        $ret = '';

        $ret .= '<div id="menu">
                    <ul>
                        <li><a href="?">Back</a></li>
                    </ul>
                </div>';

        return $ret;
    }

    /**
     * @return string
     */
    private function generateTask(){
        $ret = '';
        $id = $this->getTaskid();
        $user = $this->LoginModel->getCurrentUser();
        $task = $user->getTaskById($id);
        $details = $task->getDetails();
        if(empty($task) && $task == null) {
            $ret .='<p class="middle">Error loading task</p>';
        }
        else{
            $ret .= '<div id="task">';
            $ret .='<div class="taskTitle">'.
                        $task->getTitle()
                    .'</div>
                    <div class="center">
                        <p>'.
                        nl2br($details)
                        .'</p>
                    </div>';

            $ret .=$this->generateLinksForTask($id, $task->IsTaskFinished());
            $ret .= '</div>';
        }

        return $ret;
    }

    /**
     * @param $id
     * @param $isFinished
     * @return string
     */
    private function generateLinksForTask($id, $isFinished){
        return '<div class="middle">
                    <a class="button" href="?'. self::$Edit .'='. $id .'">Edit</a>
                    <form method="post" action="">
                        <button type="submit" name="'. self::$Delete .'" value="'. $id .'">Delete</button>'.
                        $this->generateFinishButton($id, $isFinished)
                    .'</form>
                </div>
                ';
    }

    /**
     * @param $id
     * @param $isFinished
     * @return string
     */
    private function generateFinishButton($id, $isFinished){
        if($isFinished){
            return '<button type="submit" name="'. self::$Unfinish .'" value="'. $id .'">UnFinish</button>';
        }
        else{
            return '<button type="submit" name="'. self::$Finish .'" value="'. $id .'">Finish</button>';
        }

    }



    /**
     * @return bool
     */
    public function doesUserWantToCreate(){
        return isset($_GET[self::$Create]);
    }

    /**
     * @return bool
     */
    public function doesUserWantToWatchTask(){
        return isset($_GET[self::$Task]);
    }

    /**
     * @return int
     */
    public function getTaskid(){
        return $_GET[self::$Task];
    }

    /**
     * @return bool
     */
    public function doesUserWantToDelete(){
        return isset($_POST[self::$Delete]);
    }

    /**
     * @return mixed
     */
    public function getDeleteId(){
        return $_POST[self::$Delete];
    }

    /**
     * @return bool
     */
    public function doesUserWantToFinish(){
        return isset($_POST[self::$Finish]);
    }

    /**
     * @return mixed
     */
    public function getFinishId(){
        return $_POST[self::$Finish];
    }

    /**
     * @return bool
     */
    public function doesUserWantToUnFinish(){
        return isset($_POST[self::$Unfinish]);
    }

    /**
     * @return mixed
     */
    public function getUnfinishId(){
        return $_POST[self::$Unfinish];
    }

    /**
     * @return bool
     */
    public function doesUserWantToEdit(){
        return isset($_GET[self::$Edit]);
    }

    /**
     * @return mixed
     */
    public function getEditId(){
        return $_GET[self::$Edit];
    }
}