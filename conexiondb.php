<?php
// Datos de conexión a la base de datos
$servername = "localhost";  // Servidor
$username = "root";         // Usuario de XAMPP (por defecto es 'root')
$password = "";             // Contraseña (por defecto vacía en XAMPP)
$dbname = "formulario_registro"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.";
}

// Aquí puedes ejecutar otras consultas SQL si lo necesitas

?>