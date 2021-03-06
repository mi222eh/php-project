<?php
class UsernameNotAStringException extends Exception{}
class PasswordNotAStringException extends Exception{}

class User{
    
    private $name;
    private $password;
    private $Tasks = array();

    /**
     * @param $name
     * @param $password
     * @throws PasswordNotAStringException
     * @throws UsernameNotAStringException
     */
    function __construct($name, $password){
        
        if(!is_string($name)){
            throw new UsernameNotAStringException();
        }
        
        if(!is_string($password)){
            throw new PasswordNotAStringException();
        }
        
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * @return array
     */
    public function getTasks(){
        return $this->Tasks;
    }

    /**
     * @param $task
     * @param $details
     */
    public function addNote($task, $details){
        $id = 0;
        foreach ($this->Tasks as $note) {
            if($note->getId() > $id){
                $id = $note->getId();
            }
        }
        $id += 1;

        $this->Tasks[] = new Task($task, $details, $id);
    }

    /**
     * @param $Id
     * @return Task || null
     */
    public function getTaskById($Id){
        $task = null;
        foreach($this->Tasks as $note){
            if($note->getId() == $Id){
                return $note;
            }
        }
        return $task;
    }

    /**
     * @param $id
     */
    public function deleteTask($id){
        foreach($this->Tasks as $key=>$task){
            if($task->getId() == $id){
                unset($this->Tasks[$key]);
                return;
            }
        }
    }

    /**
     * @param $id
     */
    public function finishTask($id){
        $task = $this->getTaskById($id);
        $task->setFinished(true);

    }

    /**
     * @param $id
     */
    public function unFinishTask($id){
        $task = $this->getTaskById($id);
        $task->setFinished(false);
    }

    /**
     * @param $id
     * @param $title
     * @param $details
     */
    public function editTask($id, $title, $details){
        $task = $this->getTaskById($id);
        if(!empty($task)){
            $task->setTitle($title);
            $task->setDetails($details);
        }
    }
}