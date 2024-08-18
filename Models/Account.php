<?php
require_once 'Models/Database.php';

class Account {

    public static function Auth($username , $password){
        $db = Database::getInstance();
        $field = array(
            "username"=> $username,
            "password"=> $password
        );
        return $db->getData("account",$field);
    }

    public static function create_acc($username , $password , $type){
        $db = Database::getInstance();
        $data = array(
            "username"=> $username,
            "password"=> $password,
            "type"=>$type
        );
        return $db->insert_data('account',$data);
    }

    public static function get_person($user){
        $db = Database::getInstance();
        switch ($user['type']){
            case 0:
                $admin = $db->getData("admin","username",$user['username']);
                if ($admin){
                    $personID = $admin['personID'];
                }
            case 1:
                $teacher = $db->getData("teacher","username",$user['username']);
                if ($teacher){
                    $personID = $teacher['personID'];
                }
            case 2:
                $student = $db->getData("student","username",$user['username']);
                if ($student){
                    $personID = $student['personID'];
                }
        }

        $person = $db->getData("person",'personID',$personID);
        return $person;
        
    }

}