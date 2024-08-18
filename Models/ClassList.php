<?php
require_once 'Models/Database.php';

class ClassList {

    public static function get_by_id($classListID) {
        $db = Database::getInstance();
        return $db->getData('classlist', 'classListID', $classListID);
    }

    public static function get_all_paginated($page, $perPage = 10) {
        $db = Database::getInstance();
        return $db->paginate('classlist', $page, $perPage);
    }

    public static function get_all() {
        $db = Database::getInstance();
        return $db->getDatas('SELECT * FROM classlist');
    }

    public static function get_total_pages($perPage = 10) {
        $db = Database::getInstance();
        $totalRecords = $db->countRows('classlist');
        return ceil($totalRecords / $perPage);
    }

    public static function create($classList) {
        $db = Database::getInstance();
        
        $classListData = array(
            'classID' => $classList['classID'],
            'studentID' => $classList['studentID']
        );
        
        return $db->insert_data('classlist', $classListData);
    }

    public static function update_class_list($classList) {
        $db = Database::getInstance();
        
        $classListData = array(
            'classID' => $classList['classID'],
            'studentID' => $classList['studentID']
        );
        
        return $db->update_data('classlist', $classListData, 'classListID = ' . '\''.$classList['classListID'].'\'');
    }

    public static function delete($classListID) {
        $db = Database::getInstance();
        
        // Delete the class list record
        return $db->delete_data('classlist', 'classListID = ' . '\''.$classListID.'\'');
    }
}
