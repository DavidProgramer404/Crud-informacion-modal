<?php

$conn = new mysqli("localhost","root","","informaciones");

if($conn->connect_error){
    die("Error connecting to MySQL" . $conn->connect_error);
}