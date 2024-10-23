<?php
include 'conexion.php';

$id = $_GET['id'];
$sql = "SELECT * FROM publicaciones WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $publicacion = $result->fetch_assoc();
} else {
    echo "Publicación no encontrada.";
    exit();
}

$sql_comentarios = "SELECT * FROM comentarios WHERE publicacion_id = $id ORDER BY fecha DESC";
$result_comentarios = $conn->query($sql_comentarios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($publicacion['titulo']); ?></title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($publicacion['titulo']); ?></h1>
    <p><?php echo htmlspecialchars($publicacion['contenido']); ?></p>
    <small>Por <?php echo htmlspecialchars($publicacion['autor']); ?> el <?php echo $publicacion['fecha']; ?></small>

    <h2>Comentarios:</h2>
    <div id="comentarios">
        <?php
        if ($result_comentarios->num_rows > 0) {
            while ($comentario = $result_comentarios->fetch_assoc()) {
                echo "<div class='comentario'>";
                echo "<p>" . htmlspecialchars($comentario['comentario']) . "</p>";
                echo "<small>Por " . htmlspecialchars($comentario['autor_comentario']) . " el " . $comentario['fecha'] . "</small>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>Aún no hay comentarios.</p>";
        }
        ?>
    </div>

    <h3>Agregar comentario:</h3>
    <form action="guardar_comentario.php" method="POST">
        <input type="hidden" name="publicacion_id" value="<?php echo $publicacion['id']; ?>">
        <textarea name="comentario" placeholder="Escribe tu comentario aquí..." required></textarea><br><br>
        <button type="submit">Comentar</button>
    </form>
</body>
</html>
