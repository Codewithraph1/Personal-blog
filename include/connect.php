<?php

$web_title = "CodewithRaph e-commerce";
$web_name = "CodewithRaph e-commerce";
$web_number = "+1-234-567-890";
$web_email = "investment@mail.com";
$web_url = "http://localhost/blog/";
$web_address = "califonia RD texas";





$servername = "localhost"; // or your database server
$username = "root";    // your database username
$password = "";    // your database password
$dbname = "blog"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    

?>