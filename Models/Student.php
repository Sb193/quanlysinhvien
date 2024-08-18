<?php
require_once 'Models/Database.php';
require_once 'Models/Account.php';
require_once 'Models/Person.php';

class Student {

    public static function get_by_id($studentID) {
        $db = Database::getInstance();
        $student = $db->getData("student", 'studentID', $studentID);
        
        if ($student) {
            $student['person'] = Person::get_person($student['personID']);
        }

        return $student;
    }

    public static function get_all_paginated($page, $perPage = 10) {
        $db = Database::getInstance();
        return $db->paginate('student , person', $page, $perPage, 'student.personID = person.personID');
    }

    public static function get_student_by_username($username){
        $db = Database::getInstance();
        return $db->getData('student','username',$username);
    }
    public static function get_total_pages($perPage = 10) {
        $db = Database::getInstance();
        $totalRecords = $db->countRows("student");
        return ceil($totalRecords / $perPage);
    }

    public static function create($student) {
        $db = Database::getInstance();
        
        // Insert the person first
        $personID = $db->insert_data('person', $student['person']);
        
        
        
        if ($personID) {
            
            $acc = Account::create_acc($student['studentID'] , '123456' , '2');
            
            // Insert the student with the newly created personID
            $studentData = array(
                'studentID' => $student['studentID'],
                'username' => $student['studentID'],
                'course' => $student['course'],
                'personID' => $personID
            );
            $db->insert_data('student', $studentData);
            return true;

        }
        
        return false;
    }

    public static function update_student($student) {
        $db = Database::getInstance();
        
        // Update the student details
        return $db->update_data('student', $student, 'studentID = ' .'\''. $student['studentID'].'\'');
    }

    public static function delete($studentID) {
        $db = Database::getInstance();
        
        // Get the student to obtain the personID
        $student = self::get_by_id($studentID);
        
        if ($student) {
            // Delete the student record
            $db->delete_data('student', 'studentID = ' . '\''.$studentID.'\'');
            $db->delete_data('account', 'username = ' . '\''.$student['username'].'\'');
            // Delete the associated person record
            return $db->delete_data('person', 'personID = ' . $student['personID']);
        }

        return false;
    }
}
