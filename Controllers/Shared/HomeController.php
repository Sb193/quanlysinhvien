<?php
require_once "Models/Account.php";
require_once "Models/Person.php";
class HomeController {
    
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch ($action) {
            case 'index':
                $this->index();
                break;
            case 'logout':
                $this->logout();
                break;
            case '403':
                $this->e403();
                break;
            case 'get_profile':
                $this->get_profile();
                break;
            case 'profile':
                $this->profile();
                break;
            case 'upload':
                $this->upload();
                break;
            case 'upload_ps':
                $this->upload_ps();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function index() {
        switch ($_SESSION['user']['type']) {
            case 2:
                $content = "Views/Student/Home/home.php";
                $navbar = "Views/Student/Navbar/navbar.php";
                break;
            case 1:
                $content = "Views/Teacher/Home/home.php";
                $navbar = "Views/Teacher/Navbar/navbar.php";
                break;
            case 0:
                $content = "Views/Admin/Home/home.php";
                $navbar = "Views/Admin/Navbar/navbar.php";
                break;
        }
        include "Views/Shared/Layout/layout.php";
    }

    private function profile(){
        $content = "Views/Shared/Home/profile.php";
        switch ($_SESSION['user']['type']) {
            case 2:
                $navbar = "Views/Student/Navbar/navbar.php";
                break;
            case 1:
                $navbar = "Views/Teacher/Navbar/navbar.php";
                break;
            case 0:
                $navbar = "Views/Admin/Navbar/navbar.php";
                break;
        }
        include "Views/Shared/Layout/layout.php";
    }

    private function upload(){
        if (!empty($_FILES)) {
            $targetDir = "assets/img/avatar/";
            $data = Account::get_person($_SESSION['user']);
            $fileName = $data['personID'].".png";
            $targetFilePath = $targetDir . $fileName;
        
            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            
            // Di chuyển tệp vào thư mục đích
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                $data['avatar'] = $targetFilePath;
                Person::update_persons($data);
                echo $targetFilePath; // Trả về đường dẫn của file đã tải lên
            } else {
                echo "Có lỗi xảy ra khi tải lên.";
            }
        }
    }

    private function upload_ps(){
        if (!empty($_FILES)) {
            $targetDir = "assets/img/avatar/";
            $data = Person::get_person($_GET['personID']);
            $fileName = $data['personID'].".png";
            $targetFilePath = $targetDir . $fileName;
        
            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            
            // Di chuyển tệp vào thư mục đích
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                $data['avatar'] = $targetFilePath;
                Person::update_persons($data);
                echo $targetFilePath; // Trả về đường dẫn của file đã tải lên
            } else {
                echo "Có lỗi xảy ra khi tải lên.";
            }
        }
    }

    private function e403(){
        $content = "Views/Shared/Home/error403.php";
        include "Views/Shared/Layout/layout.php";
    }

    private function logout() {
        $_SESSION['user'] = null;
        require 'index.php';
    }

    private function get_profile(){
        if (isset($_SESSION['user'])){
            $data = Account::get_person($_SESSION['user']);
            echo json_encode($data);
        } else {
            $data = array(
                'error' => 'The authenticity fails'
            );
            echo json_encode($data);
        }
    }
}