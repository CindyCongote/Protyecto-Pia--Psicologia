<?php
include 'conexion.php';

$sql = "SELECT * FROM publicaciones ORDER BY fecha DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro</title>
    <link rel="stylesheet" href="./CSS/foro.css">
</head>
<body>
    <h1>Foro de Publicaciones</h1>
    <form action="guardar_publicacion.php" method="POST">
        <input type="text" name="titulo" placeholder="Título de la publicación" required><br><br>
        <textarea name="contenido" placeholder="Escribe tu publicación aquí..." required></textarea><br><br>
        <button type="submit">Publicar</button>
    </form>

    <h2>Publicaciones recientes:</h2>
    <div id="publicaciones">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='publicacion'>";
                echo "<h3><a href='publicacion.php id=" . $row['id'] . "'>" . htmlspecialchars($row['titulo']) . "</a></h3>";
                echo "<p>" . htmlspecialchars($row['contenido']) . "</p>";
                echo "<small>Por " . htmlspecialchars($row['autor']) . " el " . $row['fecha'] . "</small>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>Aún no hay publicaciones.</p>";
        }
        ?>
    </div>
</body>
</html>
