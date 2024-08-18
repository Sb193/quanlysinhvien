<?php
require_once 'Models/Database.php';

class Score {

    public static function get_by_id($scoreID) {
        $db = Database::getInstance();
        return $db->getData('score', 'scoreID', $scoreID);
    }

    public static function get_all_paginated($page, $perPage = 10) {
        $db = Database::getInstance();
        return $db->paginate('score', $page, $perPage);
    }

    public static function get_all() {
        $db = Database::getInstance();
        return $db->getDatas('SELECT * FROM score');
    }

    public static function get_total_pages($perPage = 10) {
        $db = Database::getInstance();
        $totalRecords = $db->countRows('score');
        return ceil($totalRecords / $perPage);
    }

    public static function create($score) {
        $db = Database::getInstance();
        
        
        return $db->insert_data('score', $score);
    }

    public static function update_score($score) {
        $db = Database::getInstance();
        
        $scoreData = array(
            'classListID' => $score['classListID'],
            'teacherID' => $score['teacherID'],
            'attendanceScore' => $score['attendanceScore'],
            'examScore' => $score['examScore'],
            'finalScore' => $score['finalScore'],
            'comment' => $score['comment']
        );
        
        return $db->update_data('score', $scoreData, 'scoreID = ' . '\''.$score['scoreID'].'\'');
    }

    public static function delete($scoreID) {
        $db = Database::getInstance();
        
        // Delete the score record
        return $db->delete_data('score', 'scoreID = ' . '\''.$scoreID.'\'');
    }
}
