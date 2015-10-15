<?php

class ToDoListView{
    private $LoginModel;

    /**
     * @param LoginModel $LoginModel
     */
    function __construct(LoginModel $LoginModel){
        $this->LoginModel = $LoginModel;
    }

    public function response(){
        $ret = '';
        $ret .= $this->generateLinks();
        $ret .='LIST OF TO DOOS HAHAHAHAHA';
        return $ret;
    }

    private function generateLinks(){
        return '<div id="menu">
                    <ul>
                        <li><a href="#">New task</a></li>
                    </ul>
                </div>';
    }

    private function generateToDoList(){

    }


}