<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $contenido = $conn->real_escape_string($_POST['contenido']);
    $autor = $conn->real_escape_string($_POST['autor']);

    $sql = "INSERT INTO publicaciones (titulo, contenido, autor) VALUES ('$titulo', '$contenido', '$autor')";

    if ($conn->query($sql) === TRUE) {
        header("Location: foro.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
