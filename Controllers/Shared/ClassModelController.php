<?php
require_once "Models/ClassModel.php";
require_once "Models/Subject.php";
require_once "Models/Teacher.php";
require_once "Models/Student.php";
require_once "Models/SubjectRegis.php";

class ClassController {
    
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
            case 'approved':
                $this->approved();
                break;
            case 'rejected':
                $this->rejected();
                break;
            case 'register':
                $this->register();
                break;
            case 'registerclass':
                $this->registerClassView();
                break;
            case 'register_class':
                $this->registerClass();
                break;
            case 'register_list':
                $this->registerList();
                break;
            case 'management':
                $this->management();
                break;  
            case 'list_student':
                $this->list_student();
                break;
            case 'list_class':
                $this->list_class();
                break;
            case 'subjectRegis':
                $this->list_class_regis();
                break;
            case 'student_regis':
                $this->student_regis();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function add() {
        $subjects = Subject::get_all();  // Get all subjects
        $teachers = Teacher::get_all();  // Get all teachers
        $content = "Views/Admin/Class/add.php";
        $navbar = "Views/Admin/Navbar/navbar.php";
        include "Views/Shared/Layout/layout.php";
    }

    private function create() {
        // Lấy dữ liệu từ POST request
        $classData = array(
            'subjectID' => $_POST['subjectID'],
            'teacherID' => $_POST['teacherID'],
            'className' => $_POST['className'],
            'quantity' => $_POST['quantity'],
            'status' => $_POST['status'] ?? 'pending'
        );

        // Kiểm tra dữ liệu hợp lệ
        $errors = [];
        if (empty($classData['subjectID'])) $errors[] = 'Môn học không được để trống.';
        if (empty($classData['teacherID'])) $errors[] = 'Giảng viên không được để trống.';
        if (empty($classData['className'])) $errors[] = 'Tên lớp học không được để trống.';

        // Nếu có lỗi, trả về thông báo lỗi
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            exit;
        }

        $flag = ClassModel::create($classData);

        if ($flag) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi thêm lớp học.']);
        }
    }

    private function edit() {
        if (isset($_GET['id'])) {
            $class = ClassModel::get_by_id($_GET['id']);
            if ($class) {
                $subjects = Subject::get_all();  // Get all subjects
                $teachers = Teacher::get_all();  // Get all teachers
                $content = "Views/Admin/Class/edit.php";
                $navbar = "Views/Admin/Navbar/navbar.php";
                include "Views/Shared/Layout/layout.php";
            } else {
                header('index.php?controller=home&action=e403');
            }
        } else {
            header('index.php?controller=home&action=e403');
        }
    }

    private function update() {
        // Lấy dữ liệu từ POST request
        $classData = array(
            'classID' => $_POST['classID'],
            'subjectID' => $_POST['subjectID'],
            'teacherID' => $_POST['teacherID'],
            'className' => $_POST['className'],
            'quatity' => $_POST['quatity'],
            'status' => $_POST['status'] ?? 'pending'
        );

        // Kiểm tra dữ liệu hợp lệ
        $errors = [];
        if (empty($classData['subjectID'])) $errors[] = 'Môn học không được để trống.';
        if (empty($classData['teacherID'])) $errors[] = 'Giảng viên không được để trống.';
        if (empty($classData['className'])) $errors[] = 'Tên lớp học không được để trống.';

        // Nếu có lỗi, trả về thông báo lỗi
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            exit;
        }

        $flag = ClassModel::update_class($classData);

        if ($flag) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật lớp học.']);
        }
    }

    private function delete() {
        $classID = $_POST['classID'];

        if (ClassModel::delete($classID)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi xóa lớp học.']);
        }
    }

    private function approved() {
        $classID = $_GET['id'];

        if (ClassModel::update_status($classID, 'approved')) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi phê duyệt lớp học.']);
        }
    }

    private function rejected() {
        $classID = $_GET['id'];

        if (ClassModel::update_status($classID, 'rejected')) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi từ chối lớp học.']);
        }
    }

    private function register() {
        $student = Student::get_student_by_username($_SESSION['user']['username']);
        // Lấy dữ liệu từ POST request
        $registrationData = array(
            'studentID' => $student[0]['studentID'],
            'classID' => $_POST['classID'],
            'regisDate' => date('Y-m-d'),
            'status' => 'pending'
        );

        // Kiểm tra dữ liệu hợp lệ
        $errors = [];
        if (empty($registrationData['studentID'])) $errors[] = 'Sinh viên không được để trống.';
        if (empty($registrationData['classID'])) $errors[] = 'Lớp học không được để trống.';

        // Nếu có lỗi, trả về thông báo lỗi
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            exit;
        }

        $flag = SubjectRegis::create($registrationData);

        if ($flag) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi đăng ký lớp học.']);
        }
    }

    private function registerClassView() {
        $subjects = Subject::get_all();
        $navbar = 'Views/Teacher/Navbar/navbar.php';
        $content = 'Views/Teacher/Home/register.php';

        include 'Views/Shared/Layout/layout.php';
    }

    private function registerClass() {
        $teacher = Teacher::get_teacher_by_user($_SESSION['user']['username']);
        // Lấy dữ liệu từ POST request
        $registrationData = array(
            'className' => $_POST['className'],
            'quantity' => isset($_POST['quantity']) ? $_POST['quantity'] : 0,
            'subjectID' => $_POST['subjectID'],
            'teacherID' => $teacher['teacherID']
        );

        // Kiểm tra dữ liệu hợp lệ
        $errors = [];
        if (empty($registrationData['subjectID'])) $errors[] = 'Môn dạy không được để trống.';
        if (empty($registrationData['className'])) $errors[] = 'Tên lớp học không được để trống.';

        // Nếu có lỗi, trả về thông báo lỗi
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            exit;
        }

        $flag = ClassModel::create($registrationData);

        if ($flag) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi đăng ký lớp học.']);
        }

    }

    private function registerList() {

        $data = ClassModel::get_all_register_by_teacher(Teacher::get_teacher_by_user($_SESSION['user']['username'])['teacherID']);

        $navbar = 'Views/Teacher/Navbar/navbar.php';
        $content = 'Views/Teacher/Home/registerlist.php';

        include 'Views/Shared/Layout/layout.php';
    }

    private function management() {

        $data = ClassModel::get_all_class_by_teacher(Teacher::get_teacher_by_user($_SESSION['user']['username'])['teacherID']);

        $navbar = 'Views/Teacher/Navbar/navbar.php';
        $content = 'Views/Teacher/Home/management.php';

        include 'Views/Shared/Layout/layout.php';
    }

    private function list_class(){
        $student = Student::get_student_by_username($_SESSION['user']['username']);
        $data = ClassModel::get_all_class_approved($student['studentID']);
        $navbar = 'Views/Student/Navbar/navbar.php';
        $content = 'Views/Student/Home/class_list.php';

        include 'Views/Shared/Layout/layout.php';
    }

    private function list_class_regis(){
        $student = Student::get_student_by_username($_SESSION['user']['username']);
        $data = ClassModel::get_all_class_approved_regis($student['studentID']);
        $navbar = 'Views/Student/Navbar/navbar.php';
        $content = 'Views/Student/Home/subjectRegis.php';

        include 'Views/Shared/Layout/layout.php';
    }

    private function list_student() {
        $classID = $_GET['id'];
        $data = ClassModel::get_class_list($classID);

        $navbar = 'Views/Teacher/Navbar/navbar.php';
        $content = 'Views/Teacher/Home/list_student.php';

        include 'Views/Shared/Layout/layout.php';
    }

    private function student_regis() {
        $data = SubjectRegis::get_student_regis();

        $navbar = 'Views/Admin/Navbar/navbar.php';
        $content = 'Views/Admin/class/student_regis.php';

        include 'Views/Shared/Layout/layout.php';
    }

    private function index() {
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $data = ClassModel::get_all_paginateds($currentPage);
        $totalPages = ClassModel::get_total_pages();
        $navbar = 'Views/Admin/Navbar/navbar.php';
        $content = 'Views/Admin/Class/index.php';

        include 'Views/Shared/Layout/layout.php';
    }


}
