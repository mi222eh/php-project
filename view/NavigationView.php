<?php

class NavigationView{
    private static $Register = 'Register';

    /**
     * @param $isLoggedIn
     * @return string
     */
    public function response($isLoggedIn){
        $ret = '';
        $ret .= '<ul>';
        if(!$isLoggedIn){
            $ret .= $this->generateNotLoggedInPage();
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


    /**
     * @return bool
     */
    public function doesUserWantToRegister(){
        return isset($_GET[self::$Register]);
    }
}