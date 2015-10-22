<?php

class UserSession{

    /**
     *
     */
    function __construct(){
        session_start();
    }

    /**
     * @param $id
     * @param $value
     */
    public function setSession($id, $value){
        $_SESSION[$id] = $value;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isSessionSet($id){
        return isset($_SESSION[$id]);
    }

    /**
     * @param $id
     */
    public function removeSession($id){
        unset($_SESSION[$id]);
    }

    /**
     * @param $id
     * @return null|mixed
     */
    public function getSession($id){
        if(isset($_SESSION[$id])){
            return $_SESSION[$id];
        }
        return null;
    }
}