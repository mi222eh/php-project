<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);

//Models
require_once("model/DAL/UserDAL.php");
require_once("model/LoginModel.php");
require_once("model/Note.php");
require_once("model/User.php");
require_once("model/RegisterModel.php");

//Views
require_once("view/RegisterView.php");
require_once("view/LoginView.php");
require_once("view/LayoutView.php");
require_once("view/ContainerView.php");
require_once("view/NavigationView.php");

//Controllers
require_once("controller/LoginController.php");
require_once("controller/RegisterController.php");
require_once("controller/MainController.php");

//Create Models
$RegisterModel = new RegisterModel();

//Create Views
$navigationView = new NavigationView();
$loginView = new LoginView();
$registerView = new RegisterView($RegisterModel);
$layoutView = new LayoutView();
$containerView = new ContainerView($loginView, $registerView, $navigationView);


//Create Controllers
$MainController = new MainController();


//Start
echo $layoutView->render($containerView, $navigationView);