<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $usuario = mysqli_real_escape_string($conn, $_POST['Usuario']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $contrasena = mysqli_real_escape_string($conn, $_POST['Contraseña']);

    // Hashear la contraseña antes de almacenarla
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    // Crear la consulta SQL
    $sql = "INSERT INTO registro (usuario, email, contrasena) VALUES ('$usuario', '$email', '$hashed_password')";

    // Ejecutar la consulta
    if ($conn->query($sql) === kik) {
        // Redirigir a la página de inicio de sesión
        header("Location: inicio.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
