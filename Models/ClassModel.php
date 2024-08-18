<?php
require_once 'Models/Database.php';

class ClassModel {

    public static function get_by_id($classID) {
        $db = Database::getInstance();
        return $db->getData('class', 'classID', $classID);
    }

    public static function get_all_paginated($page, $perPage = 10) {
        $db = Database::getInstance();
        return $db->paginate('class', $page, $perPage);
    }

    public static function get_all() {
        $db = Database::getInstance();
        return $db->getDatas('SELECT * FROM class');
    }

    public static function get_class_list($classID) {
        $db = Database::getInstance();
        return $db->getDatas("SELECT * FROM classlist , student , person WHERE classlist.classID = $classID AND student.studentID = classlist.studentID AND student.personID = person.personID");
    }

    public static function get_all_with_subject_teacher() {
        $db = Database::getInstance();
        return $db->getDatas('
            SELECT c.*, s.subjectName, t.teacherID
            FROM class c
            JOIN subject s ON c.subjectID = s.subjectID
            LEFT JOIN teacher t ON c.teacherID = t.teacherID
        ');
    }

    public static function get_all_paginateds($page, $perPage = 10) {
        $db = Database::getInstance();
        return $db->paginate('class , subject , teacher , person', $page, $perPage , "class.subjectID = subject.subjectID AND class.teacherID = teacher.teacherID AND teacher.personID = person.personID");
    }

    public static function get_all_register_by_teacher($teacherID) {
        $db = Database::getInstance();
        return $db->getDatas("SELECT * FROM class , subject , teacher , person WHERE class.subjectID = subject.subjectID AND class.teacherID = teacher.teacherID AND teacher.personID = person.personID AND class.teacherID = '$teacherID'");
    }

    public static function get_all_class_by_teacher($teacherID) {
        $db = Database::getInstance();
        return $db->getDatas("SELECT * FROM class , subject , teacher , person WHERE class.subjectID = subject.subjectID AND class.teacherID = teacher.teacherID AND teacher.personID = person.personID AND class.teacherID = '$teacherID' AND class.status = 'success'");
    }

    public static function get_all_class_approved($studentID) {
        $db = Database::getInstance();
        return $db->getDatas("SELECT * FROM class , subject , teacher , person WHERE class.subjectID = subject.subjectID AND class.teacherID = teacher.teacherID AND teacher.personID = person.personID AND class.status = 'approved' AND class.classID NOT IN (SELECT classID FROM subjectregis WHERE studentID = '$studentID')");
    }

    public static function get_all_class_approved_regis($studentID) {
        $db = Database::getInstance();
        return $db->getDatas("SELECT class.classID , class.quatity , class.status AS classStatus , class.className , subject.subjectName , subject.credits , person.name , subjectregis.status AS registerStatus , subjectregis.regisID , subjectregis.regisDate FROM class , subject , teacher , person , subjectregis WHERE class.subjectID = subject.subjectID AND class.teacherID = teacher.teacherID AND teacher.personID = person.personID AND subjectregis.classID = class.classID AND class.classID IN (SELECT classID FROM subjectregis WHERE studentID = '$studentID')");
    }

    public static function get_total_pages($perPage = 10) {
        $db = Database::getInstance();
        $totalRecords = $db->countRows('class');
        return ceil($totalRecords / $perPage);
    }

    public static function create($class) {
        $db = Database::getInstance();
        
        $classData = array(
            'subjectID' => $class['subjectID'],
            'teacherID' => $class['teacherID'],
            'className' => $class['className'],
            'quatity' => $class['quantity']
        );
        
        return $db->insert_data('class', $classData);
    }

    public static function update_class($class) {
        $db = Database::getInstance();
        
        $classData = array(
            'subjectID' => $class['subjectID'],
            'teacherID' => $class['teacherID'],
            'className' => $class['className'],
            'quatity' => $class['quatity'],
            'status' => $class['status']
        );
        
        return $db->update_data('class', $classData, 'classID = ' . '\''.$class['classID'].'\'');
    }

    public static function update_status($classID , $status) {
        $db = Database::getInstance();
        
        $classData = array(
            
            'status' => $status
        );
        
        return $db->update_data('class', $classData,"classID = $classID");
    }

    public static function delete($classID) {
        $db = Database::getInstance();
        
        // Delete associated records in other tables
        $db->delete_data('classlist', 'classID = ' . '\''.$classID.'\'');
        $db->delete_data('subjectregis', 'classID = ' . '\''.$classID.'\'');
        
        // Delete the class record
        return $db->delete_data('class', 'classID = ' . '\''.$classID.'\'');
    }
}
