<?php

// Create a new MySQLi object and establish 
// a connection using the defined constants from 
// the config file.
$mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
$con = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
if ($con->connect_error) {
   die("Connection failed: " . $con->connect_error);
}

// Check if there is a connection error.
if ($mysqli->connect_errno != 0) {

   // If an error occurs, retrieve the error details.
   $error = $mysqli->connect_error;
   // Get the current date and time in 
   // a human-readable format.
   $error_date = date("F j, Y, g:i a");

   // Create a message combining the error and the date.
   $message = "{$error} | {$error_date} \r\n";

   // Append the error message to a log file 
   // named 'db-log.txt'.
   file_put_contents("error-log.txt", $message, FILE_APPEND);
   // Return false to indicate a connection failure.
   return false;
} else {
   // If the connection is successful, 
   // set the character set to "utf8mb4" which 
   // supports a wider range of characters. 
   $mysqli->set_charset("utf8mb4");

   // Return the MySQLi object, indicating 
   // a successful connection.
   return $mysqli;
}

?>
>