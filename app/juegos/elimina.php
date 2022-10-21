<?php

require '../config/database.php';

$id = $conn->real_escape_string( $_POST['id']);


$sql = "DELETE FROM juego  WHERE id=$id";

if($conn->query($sql)){
    
}

header('Location: index.php');
