<?php
require_once('models/Score.php');

class ScoreController {
    // Hiển thị danh sách điểm của tất cả sinh viên
    public function index() {
        $db = Database::getInstance();
        if (isset($_GET['id'])){
            $classID = $_GET['id'];
            $query = "SELECT sc.classlistID, p.name AS student_name, subject.subjectID, subject.subjectName AS subject_name, sc.attendanceScore, sc.examScore, sc.finalScore, sc.scoreID , class.className , subjectName , credits , s.studentID , p.name FROM score sc , classlist cl , student s , person p , class , subject WHERE sc.classlistID = cl.classlistID AND cl.studentID = s.studentID AND s.personID = p.personID AND cl.classID = class.classID AND class.subjectID = subject.subjectID AND class.classID = '$classID'";
        } else {
            $query = "SELECT sc.classlistID, p.name AS student_name, subject.subjectID, subject.subjectName AS subject_name, sc.attendanceScore, sc.examScore, sc.finalScore, sc.scoreID , class.className , subjectName , credits , s.studentID , p.name FROM score sc , classlist cl , student s , person p , class , subject WHERE sc.classlistID = cl.classlistID AND cl.studentID = s.studentID AND s.personID = p.personID AND cl.classID = class.classID AND class.subjectID = subject.subjectID";
        }
        $data = $db->getDatas($query);

        $content = 'Views/Teacher/Home/score.php';
        $navbar = 'Views/Teacher/Navbar/navbar.php';
        include 'Views/Shared/Layout/layout.php';
    }

    

    // Hiển thị chi tiết điểm của một sinh viên cụ thể
    public function viewStudentScore() {
        $db = Database::getInstance();
        $studentID = Student::get_student_by_username($_SESSION['user']['username'])['studentID'];
        $query = "SELECT sc.classlistID, p.name AS student_name, subject.subjectID, subject.subjectName AS subject_name, sc.attendanceScore, sc.examScore, sc.finalScore, sc.scoreID , class.className , subjectName , credits , s.studentID , p.name FROM score sc , classlist cl , student s , person p , class , subject WHERE sc.classlistID = cl.classlistID AND cl.studentID = s.studentID AND s.personID = p.personID AND cl.classID = class.classID AND class.subjectID = subject.subjectID AND s.studentID = '$studentID'";
        $data = $db->getDatas($query);

        $content = 'Views/Student/Home/score.php';
        $navbar = 'Views/Student/Navbar/navbar.php';
        include 'Views/Shared/Layout/layout.php';
    }

    // Cập nhật điểm cho một sinh viên
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $scoreID = $_POST['scoreID'];
            $attendance_score = $_POST['attendanceScore'];
            $exam_score = $_POST['examScore'];
            $final_score = $_POST['finalScore'];
    
            // Cập nhật điểm trong database
            $data = [
                'attendanceScore' => $attendance_score,
                'examScore' => $exam_score,
                'finalScore' => $final_score
            ];
            $where = "scoreID = $scoreID";
    
            $db = Database::getInstance();
            $result = $db->update_data('score', $data, $where);
    
            if ($result > 0) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    }
    

    // Xóa một bản ghi điểm
    public function deleteScore($scoreID) {
        $scoreModel = new Score();
        $result = $scoreModel->delete($scoreID);

        if ($result > 0) {
            echo json_encode(["status" => "success", "message" => "Xóa điểm thành công!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Xóa điểm thất bại!"]);
        }
    }

    // Xử lý yêu cầu từ người dùng
    public function handleRequest() {
        $action = $_GET['action'] ?? '';

        switch ($action) {

            case 'viewStudentScore':
                $this->viewStudentScore();
                break;

            case 'update':  
                $this->update();
                break;

            default:
                $this->index();
                break;
        }
    }
}
