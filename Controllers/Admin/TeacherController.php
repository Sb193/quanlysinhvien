<?php 
require_once "Models/Teacher.php";
require_once "Models/Person.php";
require_once "Models/Account.php";

class TeacherController {

    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch ($action) {
            case 'add':
                $this->add();
                break;
            case 'create':
                $this->create();
                break;
            case 'edit':
                $this->edit();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            case 'index':
            default:
                $this->index();
                break;
        }
    }

    private function add(){
        if ($_SESSION['user']['type'] == 0){
            $content = "Views/Admin/Teachers/add.php";
            $navbar = "Views/Admin/Navbar/navbar.php";
            include "Views/Shared/Layout/layout.php";
        } else {
            header('index.php?controller=home&action=e403');
        }
    }

    private function create(){
        // Lấy dữ liệu từ POST request
        $teacherID = $_POST['teacherID'];
        $name = $_POST['name'];
        $birth = $_POST['birth'];
        $cccd = $_POST['cccd'];
        $phoneNumber = $_POST['phoneNumber'];
        $placeOfBirth = $_POST['placeOfBirth'];
        $normalAddress = $_POST['normalAddress'];
        $currentAddress = $_POST['currentAddress'];

        // Kiểm tra dữ liệu hợp lệ
        $errors = [];

        if (Teacher::get_by_id($teacherID)){
            $errors[] = 'Mã giảng viên đã tồn tại!';
        } elseif (strlen($teacherID) != 16) { // Kiểm tra định dạng mã giảng viên (16 ký tự)
            $errors[] = 'Mã giảng viên không hợp lệ.(MGV bao gồm 16 ký tự)';
        }

        // Kiểm tra họ tên
        if (empty($name)) $errors[] = 'Họ tên không được để trống.';

        // Kiểm tra ngày sinh
        if (empty($birth)) $errors[] = 'Ngày sinh không được để trống.';

        // Kiểm tra CCCD
        if (empty($cccd)) {
            $errors[] = 'CCCD không được để trống.';
        } elseif (!preg_match('/^\d{12}$/', $cccd)) { // Kiểm tra định dạng CCCD (12 chữ số)
            $errors[] = 'Số CCCD không hợp lệ.';
        }

        // Kiểm tra số điện thoại
        if (empty($phoneNumber)) {
            $errors[] = 'Số điện thoại không được để trống.';
        } elseif (!preg_match('/^\d{10,11}$/', $phoneNumber)) { // Kiểm tra định dạng số điện thoại (10 hoặc 11 chữ số)
            $errors[] = 'Số điện thoại không hợp lệ.';
        }

        // Nếu có lỗi, trả về thông báo lỗi
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            exit;
        }

        $person = array(
            'name' => $name,
            'birth' => $birth,
            'cccd' => $cccd,
            'phoneNumber' => $phoneNumber,
            'placeOfBirth' => $placeOfBirth,
            'normalAddress' => $normalAddress,
            'currentAddress' => $currentAddress
        );

        $teacher = array(
            'teacherID' => $teacherID,
            'person' => $person
        );

        $flag = Teacher::create($teacher);

        if ($flag) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi thêm giảng viên.']);
        }
    }

    private function edit(){
        if (isset($_GET['id'])){
            $teacher = Teacher::get_by_id($_GET['id']);
            if ($teacher){
                if ($_SESSION['user']['type'] == 0){
                    $content = "Views/Admin/Teachers/edit.php";
                    $navbar = "Views/Admin/Navbar/navbar.php";
                    include "Views/Shared/Layout/layout.php";
                } else {
                    header('index.php?controller=home&action=e403');
                }
            } else {
                header('index.php?controller=home&action=e403');
            }
        } else {
            header('index.php?controller=home&action=e403');
        }
    }

    private function update() {
        // Lấy dữ liệu từ POST request
        $teacherID = $_POST['teacherID'];
        $name = $_POST['name'];
        $birth = $_POST['birth'];
        $cccd = $_POST['cccd'];
        $phoneNumber = $_POST['phoneNumber'];
        $placeOfBirth = $_POST['placeOfBirth'];
        $normalAddress = $_POST['normalAddress'];
        $currentAddress = $_POST['currentAddress'];

        // Kiểm tra dữ liệu hợp lệ
        $errors = [];

        // Kiểm tra họ tên
        if (empty($name)) $errors[] = 'Họ tên không được để trống.';

        // Kiểm tra ngày sinh
        if (empty($birth)) $errors[] = 'Ngày sinh không được để trống.';

        // Kiểm tra CCCD
        if (empty($cccd)) {
            $errors[] = 'CCCD không được để trống.';
        } elseif (!preg_match('/^\d{12}$/', $cccd)) { // Kiểm tra định dạng CCCD (12 chữ số)
            $errors[] = 'Số CCCD không hợp lệ.';
        }

        // Kiểm tra số điện thoại
        if (empty($phoneNumber)) {
            $errors[] = 'Số điện thoại không được để trống.';
        } elseif (!preg_match('/^\d{10,11}$/', $phoneNumber)) { // Kiểm tra định dạng số điện thoại (10 hoặc 11 chữ số)
            $errors[] = 'Số điện thoại không hợp lệ.';
        }

        // Nếu có lỗi, trả về thông báo lỗi
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            exit;
        }

        // Lấy thông tin của giảng viên từ database
        $teacher = Teacher::get_by_id($teacherID);
        if (!$teacher) {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy giảng viên.']);
            exit;
        }

        // Cập nhật thông tin giảng viên
        $updatedPerson = array(
            'personID' => $teacher['personID'],
            'name' => $name,
            'birth' => $birth,
            'cccd' => $cccd,
            'phoneNumber' => $phoneNumber,
            'placeOfBirth' => $placeOfBirth,
            'normalAddress' => $normalAddress,
            'currentAddress' => $currentAddress
        );

        $updatedTeacher = array(
            'teacherID' => $teacherID
        );

        if (Person::update_persons($updatedPerson) > 0 || Teacher::update_teacher($updatedTeacher) > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật dữ liệu.']);
        }
    }

    private function delete(){
        // Lấy ID từ request
        $teacherID = $_GET['id'];

        if (Teacher::delete($teacherID)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi xóa giảng viên.']);
        }
    }

    private function index(){
        // Lấy thông tin phân trang từ request
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        $data = Teacher::get_all_paginated($currentPage);
        $totalPages = Teacher::get_total_pages();
        $navbar = 'Views/Admin/Navbar/navbar.php';
        $content = 'Views/Admin/Teachers/index.php';

        include 'Views/Shared/Layout/layout.php';
    }
}
