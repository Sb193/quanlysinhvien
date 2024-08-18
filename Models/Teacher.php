<?php
require_once 'Models/Database.php';
require_once 'Models/Account.php';
require_once 'Models/Person.php';

class Teacher {

    public static function get_by_id($teacherID) {
        $db = Database::getInstance();
        $teacher = $db->getData("teacher", 'teacherID', $teacherID);
        
        if ($teacher) {
            $teacher['person'] = Person::get_person($teacher['personID']);
        }

        return $teacher;
    }

    public static function get_all_paginated($page, $perPage = 10) {
        $db = Database::getInstance();
        return $db->paginate('teacher , person', $page, $perPage, 'teacher.personID = person.personID');
    }

    public static function get_all(){
        $db = Database::getInstance();
        return $db->getDatas("SELECT * FROM teacher");
    }

    public static function get_all_person(){
        $db = Database::getInstance();
        return $db->getDatas("SELECT * FROM teacher, person WHERE teacher.personID = person.personID");
    }

    public static function get_total_pages($perPage = 10) {
        $db = Database::getInstance();
        $totalRecords = $db->countRows("teacher");
        return ceil($totalRecords / $perPage);
    }

    public static function create($teacher) {
        $db = Database::getInstance();
        
        // Insert the person first
        $personID = $db->insert_data('person', $teacher['person']);
        
        if ($personID) {
            // Create the account for the teacher
            $acc = Account::create_acc($teacher['teacherID'], '123456', '1');
            
            // Insert the teacher with the newly created personID
            $teacherData = array(
                'teacherID' => $teacher['teacherID'],
                'username' => $teacher['teacherID'],
                'personID' => $personID
            );
            $db->insert_data('teacher', $teacherData);
            return true;
        }
        
        return false;
    }

    public static function update_teacher($teacher) {
        $db = Database::getInstance();
        
        // Update the teacher details
        return $db->update_data('teacher', $teacher, 'teacherID = ' .'\''. $teacher['teacherID'].'\'');
    }

    public static function get_teacher_by_user($username){
        $db = Database::getInstance();
        
        // Update the teacher details
        return $db->getData('teacher' , "username",$username);
    }

    public static function delete($teacherID) {
        $db = Database::getInstance();
        
        // Get the teacher to obtain the personID
        $teacher = self::get_by_id($teacherID);
        
        if ($teacher) {
            // Delete the teacher record
            $db->delete_data('teacher', 'teacherID = ' . '\''.$teacherID.'\'');
            $db->delete_data('account', 'username = ' . '\''.$teacher['username'].'\'');
            // Delete the associated person record
            return $db->delete_data('person', 'personID = ' . $teacher['personID']);
        }

        return false;
    }
}
