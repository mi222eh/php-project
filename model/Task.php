<?php

class Task{
    private $Title;
    private $Details;
    private $IsFinished;
    private $Id;

    /**
     * @param $Title
     * @param $Details
     * @param $Id
     */
    function __construct($Title, $Details, $Id){
        $this->Title = $Title;
        $this->Details = $Details;
        $this->Id = $Id;
        $this->IsFinished = false;
    }

    /**
     * @return string
     */
    public function getTitle(){
        return $this->Title;
    }

    /**
     * @return string
     */
    public function getDetails(){
        return $this->Details;
    }

    /**
     * @return int
     */
    public function getId(){
        return $this->Id;
    }

    /**
     * @return bool
     */
    public function IsTaskFinished(){
        return $this->IsFinished;
    }

    /**
     * @param $isFinished
     */
    public function setFinished($isFinished){
        $this->IsFinished = $isFinished;
    }

    /**
     * @param $title
     */
    public function setTitle($title){
        $this->Title = $title;
    }

    /**
     * @param $details
     */
    public function setDetails($details){
        $this->Details = $details;
    }
}