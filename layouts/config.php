<?php
// Define variables to use for DB Connection
$db_type = "mysql"; // DB type
$db_host = "localhost"; // DB Host (URl/IP)
$db_user = "root"; // DB User
$db_pass = ""; // DB Password
$db_name = "library_management"; // DB Name

// Create a connection to the database using PDO and pass the defined variables above
$db = new PDO($db_type . ':host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8mb4', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
