<?php
class UsernameNotAStringException extends Exception{}
class PasswordNotAStringException extends Exception{}

class User{
    
    private $name;
    private $password;
    private $Tasks = array();
    
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
    
    public function getName(){
        return $this->name;
    }
    
    public function getPassword(){
        return $this->password;
    }

    public function getTasks(){
        return $this->Tasks;
    }

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

    public function getTaskById($Id){
        $task = null;
        foreach($this->Tasks as $note){
            if($note->getId() == $Id){
                return $note;
            }
        }
        return $task;
    }
}