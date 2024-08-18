<?php
require_once 'Models/Database.php';

class SubjectRegis {

    public static function get_by_id($regisID) {
        $db = Database::getInstance();
        return $db->getData('subjectregis', 'regisID', $regisID);
    }

    public static function get_all_paginated($page, $perPage = 10) {
        $db = Database::getInstance();
        return $db->paginate('subjectregis', $page, $perPage);
    }

    public static function get_student_regis() {
        $db = Database::getInstance();
        return $db->getDatas("SELECT class.classID , class.quatity , class.status AS classStatus , class.className , subject.subjectName , subject.credits , person.name , subjectregis.status AS registerStatus , subjectregis.regisID , subjectregis.regisDate FROM class , subject , teacher , person , subjectregis WHERE class.subjectID = subject.subjectID AND class.teacherID = teacher.teacherID AND teacher.personID = person.personID AND subjectregis.classID = class.classID");
    }

    public static function get_all() {
        $db = Database::getInstance();
        return $db->getDatas('SELECT * FROM subjectregis');
    }

    public static function get_total_pages($perPage = 10) {
        $db = Database::getInstance();
        $totalRecords = $db->countRows('subjectregis');
        return ceil($totalRecords / $perPage);
    }

    public static function create($subjectRegis) {
        $db = Database::getInstance();
        
        $subjectRegisData = array(
            'studentID' => $subjectRegis['studentID'],
            'classID' => $subjectRegis['classID'],
            'status' => $subjectRegis['status'],
            'regisDate' => $subjectRegis['regisDate']
        );
        
        return $db->insert_data('subjectregis', $subjectRegisData);
    }

    public static function update_subject_regis($subjectRegis) {
        $db = Database::getInstance();
        return $db->update_data('subjectregis', $subjectRegis, 'regisID = '.$subjectRegis['regisID']);
    }

    public static function delete($regisID) {
        $db = Database::getInstance();
        
        // Delete the subject registration record
        return $db->delete_data('subjectregis', 'regisID = ' . '\''.$regisID.'\'');
    }
}
