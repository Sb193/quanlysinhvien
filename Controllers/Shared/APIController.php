<?php

require_once 'Models/Student.php';
require_once 'Models/Database.php';
class APIController{
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch ($action) {
            case 'student':
                $this->getStudentDashboardData();
                break;
            case 'teacher':
                $this->getTeacherDashboardData();
                break;
            case 'admin':
                $this->getAdminDashboardData();
                break;
            default:
                $this->getStudentDashboardData();
                break;
        }
    }
    public function getStudentDashboardData() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $db = Database::getInstance();
            $studentID = Student::get_student_by_username($_SESSION['user']['username'])['studentID'];
    
            // Get accumulated credits
            $sql = "SELECT SUM(credits) as totalCredits FROM subjectRegis sr , class c , subject b WHERE sr.classID = c.classID AND c.subjectID = b.subjectID AND sr.studentID = '$studentID' and sr.status = 'approved'";
            $totalCredits = $db->getDatas($sql)[0]['totalCredits'];
    
            // Get accumulated points
            $sql = "SELECT SUM(finalScore * credits) / SUM(credits) as totalPoints FROM score sc , class c , subject b , classlist cl WHERE sc.classlistID = cl.classlistID AND c.subjectID = b.subjectID AND cl.classID = c.classID AND cl.studentID = '$studentID'";
            $totalPoints = $db->getDatas($sql)[0]['totalPoints'];
    
            // Get count of subjects with above-average scores
            $sql = "SELECT COUNT(*) as aboveAverageSubjects FROM score , classlist cl WHERE score.classlistID= cl.classlistID AND cl.studentID = '$studentID' AND score.finalScore >= 5.0";
            $aboveAverageSubjects = $db->getDatas($sql)[0]['aboveAverageSubjects'];
    
            // Get count of subjects with below-average scores
            $sql = "SELECT COUNT(*) as belowAverageSubjects FROM score , classlist cl WHERE score.classlistID= cl.classlistID AND cl.studentID = '$studentID' AND score.finalScore < 5.0";
            $belowAverageSubjects = $db->getDatas($sql)[0]['belowAverageSubjects'];
    
            // Get total score for each subject
            $sql = "SELECT subjectName , finalScore FROM score , classlist cl , class c , subject WHERE score.classlistID= cl.classlistID AND c.classID=cl.classID AND c.subjectID = subject.subjectID AND cl.studentID = '$studentID'";
            $subjectScores = $db->getDatas($sql);
    
            $response = [
                'totalCredits' => $totalCredits,
                'totalPoints' => $totalPoints,
                'aboveAverageSubjects' => $aboveAverageSubjects,
                'belowAverageSubjects' => $belowAverageSubjects,
                'subjectScores' => $subjectScores
            ];
    
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function getTeacherDashboardData() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $db = Database::getInstance();
            $teacherID = Teacher::get_teacher_by_user($_SESSION['user']['username'])['teacherID'];
    

            $sql = "SELECT COUNT(*) AS totalApproved FROM class WHERE teacherID = '$teacherID' AND status = 'approved'";
            $totalApproved = $db->getDatas($sql)[0]['totalApproved'];
    

            $sql = "SELECT COUNT(*) AS totalPending FROM class WHERE teacherID = '$teacherID' AND status = 'pending'";
            $totalPending = $db->getDatas($sql)[0]['totalPending'];
    

            $sql = "SELECT COUNT(*) AS totalRejected FROM class WHERE teacherID = '$teacherID' AND status = 'rejected'";
            $totalRejected = $db->getDatas($sql)[0]['totalRejected'];
    

            $sql = "SELECT COUNT(*) AS totalSuccess FROM class WHERE teacherID = '$teacherID' AND status = 'success'";
            $totalSuccess = $db->getDatas($sql)[0]['totalSuccess'];
            
            // Get total score for each subject
            $sql = "SELECT 
                        c.classID,
                        c.className,
                        COUNT(cl.studentID) AS studentCount
                    FROM 
                        Class c
                    JOIN 
                        ClassList cl ON c.classID = cl.classID
                    WHERE 
                        c.teacherID = '$teacherID'
                    GROUP BY 
                        c.classID, c.className;";

            $clases = $db->getDatas($sql);
    
            $response = [
                'totalApproved' => $totalApproved,
                'totalPending' => $totalPending,
                'totalRejected' => $totalRejected,
                'totalSuccess' => $totalSuccess,
                'Class' => $clases
            ];
    
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function getAdminDashboardData() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $db = Database::getInstance();

    

            $sql = "SELECT COUNT(*) AS totalClass FROM class WHERE status = 'success'";
            $totalClass = $db->getDatas($sql)[0]['totalClass'];
    

            $sql = "SELECT COUNT(*) AS totalTeacher FROM teacher";
            $totalTeacher = $db->getDatas($sql)[0]['totalTeacher'];
    

            $sql = "SELECT COUNT(*) AS totalStudent FROM student";
            $totalStudent = $db->getDatas($sql)[0]['totalStudent'];
    

            $sql = "SELECT COUNT(*) AS totalPending FROM class WHERE status = 'pending'";
            $totalPending = $db->getDatas($sql)[0]['totalPending'];
            
            // Get total score for each subject
            $sql = "SELECT 
                        c.classID,
                        c.className,
                        COUNT(cl.studentID) AS studentCount
                    FROM 
                        Class c
                    JOIN 
                        ClassList cl ON c.classID = cl.classID
                    GROUP BY 
                        c.classID, c.className;";

            $clases = $db->getDatas($sql);
    
            $response = [
                'totalClass' => $totalClass,
                'totalTeacher' => $totalTeacher,
                'totalStudent' => $totalStudent,
                'totalPending' => $totalPending,
                'Class' => $clases
            ];
    
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} 