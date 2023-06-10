<?php


$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/DBClass.php');
include_once($filepath . '/Session.php');
include_once($filepath . '/../includes/_helpers.php');
Session::init();


class UserClass {

    private $db;

    public function __construct($userId)
    {
        $this->id = $userId;
        $this->db = new DBClass();

    }

    public function getUserData($data = array()){
        $columns = empty($data) ? '*' : implode(',', $data);
        $query = "SELECT $columns FROM users WHERE id = '$this->id'";

        $result = $this->db->select($query);

        return $result;
    }
}

