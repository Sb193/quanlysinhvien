<?php
require_once "Models/Subject.php";

class SubjectController {

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

    private function add() {
        if ($_SESSION['user']['type'] == 0) {
            $content = "Views/Admin/Subject/add.php";
            $navbar = "Views/Admin/Navbar/navbar.php";
            include "Views/Shared/Layout/layout.php";
        } else {
            header('Location: index.php?controller=home&action=e403');
            exit;
        }
    }

    private function create() {
        // Lấy dữ liệu từ POST request
        $subjectName = $_POST['subjectName'];
        $credits = $_POST['credits'];


        // Kiểm tra dữ liệu hợp lệ
        $errors = [];
        if (empty($subjectName)) $errors[] = 'Tên môn học không được để trống.';
        if (empty($credits) || !is_numeric($credits)) $errors[] = 'Số tín chỉ phải là một số hợp lệ.';

        // Nếu có lỗi, trả về thông báo lỗi
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            exit;
        }

        $subject = [
            'subjectName' => $subjectName,
            'credits' => $credits
        ];

        $flag = Subject::create($subject);

        if ($flag) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi thêm môn học.']);
        }
    }

    private function edit() {
        if (isset($_GET['id'])) {
            $subject = Subject::get_by_id($_GET['id']);
            if ($subject) {
                if ($_SESSION['user']['type'] == 0) {
                    $content = "Views/Admin/Subject/edit.php";
                    $navbar = "Views/Admin/Navbar/navbar.php";
                    include "Views/Shared/Layout/layout.php";
                } else {
                    header('Location: index.php?controller=home&action=e403');
                    exit;
                }
            } else {
                header('Location: index.php?controller=home&action=e403');
                exit;
            }
        } else {
            header('Location: index.php?controller=home&action=e403');
            exit;
        }
    }

    private function update() {
        // Lấy dữ liệu từ POST request
        $subjectID = $_POST['subjectID'];
        $subjectName = $_POST['subjectName'];
        $credits = $_POST['credits'];

        // Kiểm tra dữ liệu hợp lệ
        $errors = [];
        if (empty($subjectName)) $errors[] = 'Tên môn học không được để trống.';
        if (empty($credits) || !is_numeric($credits)) $errors[] = 'Số tín chỉ phải là một số hợp lệ.';

        // Nếu có lỗi, trả về thông báo lỗi
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            exit;
        }

        $subject = [
            'subjectID' => $subjectID,
            'subjectName' => $subjectName,
            'credits' => $credits

        ];

        if (Subject::update_subject($subject) > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật môn học.']);
        }
    }

    private function delete() {
        // Lấy ID từ request
        $subjectID = $_GET['id'];

        if (Subject::delete($subjectID)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi xóa môn học.']);
        }
    }

    private function index() {
        // Lấy thông tin phân trang từ request
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        $data = Subject::get_all_paginated($currentPage);
        $totalPages = Subject::get_total_pages();
        $navbar = 'Views/Admin/Navbar/navbar.php';
        $content = 'Views/Admin/Subject/index.php';

        include 'Views/Shared/Layout/layout.php';
    }
}
