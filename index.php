<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);

//Models
require_once("model/DAL/UserDAL.php");
require_once("model/LoginModel.php");
require_once("model/Task.php");
require_once("model/User.php");
require_once("model/RegisterModel.php");
require_once("model/UserSession.php");
require_once("model/AddTaskModel.php");

//Views
require_once("view/RegisterView.php");
require_once("view/LoginView.php");
require_once("view/LayoutView.php");
require_once("view/ContainerView.php");
require_once("view/NavigationView.php");
require_once("view/ToDoView.php");
require_once("view/CreateToDoView.php");

//Controllers
require_once("controller/LoginController.php");
require_once("controller/RegisterController.php");
require_once("controller/MainController.php");
require_once("controller/CreateToDoController.php");

//Create Models
$RegisterModel = new RegisterModel();
$loginModel = new LoginModel();
$addTaskModel = new AddTaskModel();

//Create Views
$createToDoView = new CreateToDoView();
$toDoListView = new ToDoView($loginModel);
$navigationView = new NavigationView();
$loginView = new LoginView($loginModel);
$registerView = new RegisterView($RegisterModel);
$layoutView = new LayoutView();
$containerView = new ContainerView($loginView, $registerView, $navigationView, $toDoListView, $createToDoView);


//Create Controllers
$createToDoController = new CreateToDoController($createToDoView, $loginModel, $addTaskModel);
$loginController = new LoginController($loginView, $loginModel);
$registerController = new RegisterController($registerView, $RegisterModel);
$MainController = new MainController($containerView, $navigationView,$toDoListView ,$loginController, $registerController, $createToDoController);



//Start
$MainController->handleInput($loginModel);

$layoutView->render($containerView, $navigationView, $loginModel->isLoggedIn());