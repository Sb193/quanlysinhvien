<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once 'Models/Account.php';
require_once 'Controllers/Shared/HomeController.php';
require_once 'Controllers/Admin/StudentController.php';
require_once 'Controllers/Admin/TeacherController.php';
require_once 'Controllers/Admin/SubjectController.php';
require_once 'Controllers/Shared/PersonController.php';
require_once 'Controllers/Shared/LoginController.php';
require_once 'Controllers/Shared/ClassModelController.php';
require_once 'Controllers/Shared/SubjectRegisController.php';
require_once 'Controllers/Shared/ScoreController.php';
require_once 'Controllers/Shared/APIController.php';


$controller = null;


if (!isset($_SESSION['user'])) {
    $controller = new LoginController();
} else {
    $user = $_SESSION['user'];
    $cont = isset($_GET['controller']) ? $_GET['controller'] : null;
        switch ($cont) {
            case 'home':
                $controller = new HomeController();
                break;
            case 'person':
                $controller = new PersonController();
                break;
            case 'student':
                $controller = new StudentController();
                break;
            case 'teacher':
                $controller = new TeacherController();
                break;
            case 'subject':
                $controller = new SubjectController();
                break;
            case 'class':
                $controller = new ClassController();
                break;
            case 'score':
                $controller = new ScoreController();
                break;
            case 'subjectRegis':
                $controller = new SubjectRegisController();
                break;
            case 'api':
                $controller = new APIController();
                break;
            default:
                $controller = new HomeController();
                break;
        }
}

$controller->handleRequest();