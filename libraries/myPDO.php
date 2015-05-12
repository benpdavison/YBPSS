<?php
//script for DB connection
class myPDO extends PDO
{
// An effort has been made to mask my username from the viewer of this file by using strncmp to match the %Database name passed with my AWEB database as well as using base64 encoding
    function __construct($database)
    {
    	if (strcmp($database, "myPDODB") == 0){
    		$database = base64_decode('YnBkNTAxYXdlYg==');
    	}
        parent::__construct("mysql:dbname=$database;host=mysql-student.cs.york.ac.uk",'bpd501','vfV7yGcAmQ9d');
        // Throw exceptions. 
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
?>