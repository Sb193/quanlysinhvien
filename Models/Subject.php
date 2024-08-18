<?php
require_once 'Models/Database.php';

class Subject {

    public static function get_by_id($subjectID) {
        $db = Database::getInstance();
        return $db->getData('subject', 'subjectID', $subjectID);
    }

    public static function get_all_paginated($page, $perPage = 10) {
        $db = Database::getInstance();
        return $db->paginate('subject', $page, $perPage);
    }

    public static function get_all() {
        $db = Database::getInstance();
        return $db->getDatas('SELECT * FROM subject');
    }

    public static function get_total_pages($perPage = 10) {
        $db = Database::getInstance();
        $totalRecords = $db->countRows('subject');
        return ceil($totalRecords / $perPage);
    }

    public static function create($subject) {
        $db = Database::getInstance();
        
        $subjectData = array(
            'subjectName' => $subject['subjectName'],
            'credits' => $subject['credits']
        );
        
        return $db->insert_data('subject', $subjectData);
    }

    public static function update_subject($subject) {
        $db = Database::getInstance();
        
        $subjectData = array(
            'subjectName' => $subject['subjectName'],
            'credits' => $subject['credits']
        );
        
        return $db->update_data('subject', $subjectData, 'subjectID = ' . '\''.$subject['subjectID'].'\'');
    }

    public static function delete($subjectID) {
        $db = Database::getInstance();
        
        // Delete associated records in Class table if needed
        $db->delete_data('class', 'subjectID = ' . '\''.$subjectID.'\'');
        
        // Delete the subject record
        return $db->delete_data('subject', 'subjectID = ' . '\''.$subjectID.'\'');
    }
}
