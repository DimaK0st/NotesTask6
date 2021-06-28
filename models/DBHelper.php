<?php

class dbHelper
{

    public $host = '127.0.0.1';
    public $database = 'RemoteTestingSite';
    public $user = 'root';
    public $password = 'root';
    public $tableUserData = "userdata";
    public $link;


    public function __construct()
    {

        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database, 3307) or die("Ошибка " . mysqli_error($this->link));
    }


    public function get($userName, $email)
    {
        $query = "SELECT * FROM test";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        if ($result) {
            return mysqli_num_rows($result);
        }
    }


    public function add($id)
    {
        $query = "INSERT INTO test (id) VALUES('" . $id . "'" . ")";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        if ($result) {
            return mysqli_num_rows($result);
        }
    }


    public function __destruct()
    {
        mysqli_close($this->link);
    }


}