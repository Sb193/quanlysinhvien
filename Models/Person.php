<?php
require_once 'Models/Database.php';

class Person {


    public static function get_person($personID){
        $db = Database::getInstance();
        $person = $db->getData("person",'personID',$personID);
        return $person; 
    }

    public static function get_persons(){
        $db = Database::getInstance();
        $persons = $db->getDatas("person");
        return $persons; 
    }

    public static function update_persons($person){
        $db = Database::getInstance();
        return $db->update_data('person',$person , 'personID = '.$person['personID']); 
    }

}