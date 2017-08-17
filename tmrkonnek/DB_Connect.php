<?php

class DB_Connect
{
    
    // constructor
    function __construct()
    {
        
    }
    
    // destructor
    function __destruct()
    {
        // $this->close();
    }
    
    public function connect()
    {
        require_once "config.php";
        $con = mysql_connect("localhost", "root", "root");
        // selecting database
        mysql_select_db("android");
        // return database handler
        return $con;
    }
    
    public function close()
    {
        mysql_close();
    }
}
?>