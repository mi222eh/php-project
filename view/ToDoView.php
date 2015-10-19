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
        if(empty($tasks)){
            return '<p class="middle">No tasks were found</p>';
        }

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
                $ret .= $this->generateLinksForTask($task->getId());
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

    private function generateTask(){
        $ret = '';
        $id = $this->getTaskid();
        $user = $this->LoginModel->getCurrentUser();
        $task = $user->getTaskById($id);
        var_dump($id);
        if(empty($task) && $task == null) {
            return '<p class="middle">Error loading task</p>';
        }
        else{
            return$this->generateLinksForTask($id);
        }
    }

    private function generateLinksForTask($id){
        return '<div class="middle">
                    <a class="button" href="?'. self::$Edit .'">Edit</a>
                    <form method="post" action="">
                        <button type="submit" name="'. self::$Delete .'" value="'. $id .'">Delete</button>
                        <button type="submit" name="'. self::$Finish .'" value="'. $id .'">Finished</button>
                    </form>
                </div>
                ';
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

    public function doesUserWantToDelete(){
        return isset($_POST[self::$Delete]);
    }

    public function getDeleteId(){
        return $_POST[self::$Delete];
    }
}