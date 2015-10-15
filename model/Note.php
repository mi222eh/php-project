<?php

class Note{
    private $Title;
    private $Details;
    private $Id;
    
    function __construct($Title, $Details, $Id){
        $this->Title = $Title;
        $this->Details = $Details;
        $this->Id = $Id;
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
}