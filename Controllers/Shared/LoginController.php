<?php
require_once 'Models/Account.php';
class LoginController {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch ($action) {
            case 'login':
                $this->login();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index() {
        include 'Views/Shared/Login/login.php';
    }

    private function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = Account::Auth($username , $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header("location:index.php?controller=home&action=index");
            } 
            $error = '';
            $usernamenull = '';
            $passwordnull = '';
            if ($username == ''){
                $error = 'Tài khoản không được để trống';
                $usernamenull = 'border-danger';
                include 'Views/Shared/Login/login.php';
            } elseif ($password == ''){
                $error = 'Mật khẩu không được để trống';
                $passwordnull = 'border-danger';
                include 'Views/Shared/Login/login.php';
            } else {
                $error = 'Tài khoản hoặc mật khẩu không đúng';
                include 'Views/Shared/Login/login.php';
            }
                
            
        }
    }
}