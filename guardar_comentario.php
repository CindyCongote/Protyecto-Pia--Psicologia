<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $publicacion_id = $conn->real_escape_string($_POST['publicacion_id']);
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $autor_comentario = $conn->real_escape_string($_POST['autor_comentario']);

    $sql = "INSERT INTO comentarios (publicacion_id, comentario, autor_comentario) VALUES ('$publicacion_id', '$comentario', '$autor_comentario')";

    if ($conn->query($sql) === TRUE) {
        header("Location: publicacion.php?id=" . $publicacion_id);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
