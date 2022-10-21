<?php

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);

$sql = "SELECT id, nombre, descripcion, id_genero FROM juego WHERE id = $id LIMIT 1";
$resultado = $conn->query($sql);
$rows = $resultado->num_rows;

$juego = []; 

if ($rows > 0) {
    $juego = $resultado->fetch_array();

}

echo json_encode($juego, JSON_UNESCAPED_UNICODE);

?>