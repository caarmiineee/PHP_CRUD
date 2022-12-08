<?php
class MyDB extends SQLite3
{
    //path file json
    private $confPath = "student_management.json";

    function __construct()
    {
        //open data base
        $this->open('student_management.db');
    }

    //get value of file json
    function loadConf(){
        return json_decode(file_get_contents($this->confPath));
    }
    //save in file json
    function saveConf($data){
        file_put_contents($this->confPath,json_encode($data));
    }
}

$db = new MyDB();

// sql to create table
$create_students = "CREATE TABLE IF NOT EXISTS Students (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
	age INTEGER NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)";

$db->exec($create_students)
?>