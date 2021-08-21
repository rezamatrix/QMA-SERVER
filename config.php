<?php
// Initialize variable for database credentials
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'qaa';
//Create database connection
  $dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
?>