<?php

class NavigationView{
    private static $Register = 'Register';
    private static $NewNote = 'New';
    
    public function response($isLoggedIn){
        $ret = '';
        $ret .= '<ul>';
        if(!$isLoggedIn){
            $ret .= $this->generateNotLoggedInPage();
        }
        else{
            $ret .= $this->generateLoggedInPage();
        }
        $ret .= '</ul>';
        
        return $ret;
        
    }
    
    private function generateNotLoggedInPage(){
        if($this->doesUserWantToRegister()){
            return '<li>
                    <a href="?">Back to login</a>
                </li>';
        }
        else{
            return '<li>
                    <a href="?'. self::$Register .'">Register new user </a>
                </li>';
        }
        
    }

    private function generateLoggedInPage(){

    }
    
    
    public function doesUserWantToRegister(){
        return isset($_GET[self::$Register]);
    }
}