<?php
require_once "Models/SubjectRegis.php";
require_once "Models/ClassList.php";
require_once "Models/Score.php";
class SubjectRegisController {
    
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch ($action) {
            case 'approved':
                $this->approved();
                break; 
            case 'rejected':
                $this->rejected();
                break; 
        }


    }

    private function approved(){
        // Lấy dữ liệu từ POST request
        $regisID = $_GET['id'];

        // Kiểm tra dữ liệu hợp lệ
        $regis = SubjectRegis::get_by_id($regisID);

        if (!$regis){
            $errors[] = 'Mã đăng ký không tồn tại!';
        } 

        
        // Nếu có lỗi, trả về thông báo lỗi
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            exit;
        }

        $regis_new = array(
            'regisID' => $regis['regisID'],
            'status' => 'approved'
        );

        
    

        $register = array(
            'studentID'=>$regis['studentID'],
            'classID' => $regis['classID']
        );

        $flag = ClassList::create($register);

        if ($flag ){
            $score = array(
                'classListID' => $flag, 
                'attendanceScore' => 0, 
                'examScore' => 0, 
                'finalScore'=> 0
            );

            Score::create($score);
        }

        $flag = SubjectRegis::update_subject_regis($regis_new);

        if ($flag) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra duyệt']);
        }
    }

    private function rejected(){
        // Lấy dữ liệu từ POST request
        $regisID = $_GET['id'];

        // Kiểm tra dữ liệu hợp lệ
        $regis = SubjectRegis::get_by_id($regisID);

        if (!$regis){
            $errors[] = 'Mã đăng ký không tồn tại!';
        } 

        
        // Nếu có lỗi, trả về thông báo lỗi
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            exit;
        }

        $regis_new = array(
            'regisID' => $regis['regisID'],
            'status' => 'rejected'
        );
    

        $flag = SubjectRegis::update_subject_regis($regis_new);

        if ($flag) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra duyệt']);
        }
    }

    

    
    
}