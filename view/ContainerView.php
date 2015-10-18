<?php

class ContainerView{
    private $LoginView;
    private $RegisterView;
    private $NavigationView;
    private $ToDoListView;
    private $CreateToDoView;

    /**
     * @param LoginView $LoginView
     * @param RegisterView $RegisterView
     * @param NavigationView $NavigationView
     * @param ToDoView $ToDoListView
     * @param CreateToDoView $CreateToDoView
     */
    function __construct(LoginView $LoginView, RegisterView $RegisterView, NavigationView $NavigationView, ToDoView $ToDoListView, CreateToDoView $CreateToDoView){
        $this->LoginView = $LoginView;
        $this->RegisterView = $RegisterView;
        $this->NavigationView = $NavigationView;
        $this->ToDoListView = $ToDoListView;
        $this->CreateToDoView = $CreateToDoView;
    }

    /**
     * @param bool $isLoggedIn
     * @return string
     */
    public function response($isLoggedIn){
        $ret = '';
        if($isLoggedIn){
            $ret .= $this->LoginView->response();
            if($this->NavigationView->doesUserWantToRegister()){
                $ret .= $this->RegisterView->response();
            }
            elseif($this->ToDoListView->doesUserWantToCreate()){
                $ret .= $this->CreateToDoView->response();
            }
            else{
                $ret .= $this->ToDoListView->response();
            }
        }
        else{
            if($this->NavigationView->doesUserWantToRegister()){
                $ret .= $this->RegisterView->response();
            }
            else{
                $ret .= $this->LoginView->response();
            }
        }

        return $ret;


    }
}