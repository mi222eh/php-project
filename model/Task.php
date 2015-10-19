<?php

class Task{
    private $Title;
    private $Details;
    private $IsFinished;
    private $Id;
    
    function __construct($Title, $Details, $Id){
        $this->Title = $Title;
        $this->Details = $Details;
        $this->Id = $Id;
        $this->IsFinished = false;
    }
    
    public function getTitle(){
        return $this->Title;
    }
    
    public function getDetails(){
        return $this->Details;
    }
    
    public function getId(){
        return $this->Id;
    }

    public function IsTaskFinished(){
        return $this->IsFinished;
    }

    public function setFinished($isFinished){
        $this->IsFinished = $isFinished;
    }

    public function setTitle($title){
        $this->Title = $title;
    }

    public function setDetails($details){
        $this->Details = $details;
    }
}