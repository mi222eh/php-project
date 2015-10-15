<?php

class ContainerView{
    private $LoginView;
    private $RegisterView;
    private $NavigationView;
    private $ToDoListView;

    /**
     * @param LoginView $LoginView
     * @param RegisterView $RegisterView
     * @param NavigationView $NavigationView
     * @param ToDoListView $ToDoListView
     */
    function __construct(LoginView $LoginView, RegisterView $RegisterView, NavigationView $NavigationView, ToDoListView $ToDoListView){
        $this->LoginView = $LoginView;
        $this->RegisterView = $RegisterView;
        $this->NavigationView = $NavigationView;
        $this->ToDoListView = $ToDoListView;
    }

    /**
     * @param bool $isLoggedIn
     * @return string
     */
    public function response($isLoggedIn){
        $ret = '';
        if($this->NavigationView->doesUserWantToRegister()){
            return $this->RegisterView->response();
        }
        else {
            $ret .= $this->LoginView->response();
            if($isLoggedIn){
                $ret .= $this->ToDoListView->response();
            }
        }

        return $ret;


    }
}