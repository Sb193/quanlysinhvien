<?php
require_once "Models/Account.php";
require_once "Models/Person.php";
class PersonController {
    
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch ($action) {
            case 'update':
                $this->update();
                break;
            
            
        }
    }

    

    private function update(){
        // Lấy dữ liệu từ POST request
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

        $person = Account::get_person($_SESSION['user']);
        $new_person = array(
            'personID' => $person['personID'],
            'name' => $_POST['name'],
            'birth' => $_POST['birth'],
            'cccd' => $_POST['cccd'],
            'phoneNumber' => $_POST['phoneNumber'],
            'placeOfBirth' => $_POST['placeOfBirth'],
            'normalAddress' => $_POST['normalAddress'],
            'currentAddress' => $_POST['currentAddress']
        );

        if (Person::update_persons($new_person) > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật dữ liệu ']);
        }
    }

    

    
}