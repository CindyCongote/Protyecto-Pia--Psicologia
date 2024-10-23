<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

session_start(); // Iniciar sesión para gestionar sesiones de usuario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $email = $_POST['Email'];
    $contraseña = $_POST['Contraseña']; // Corregido para coincidir con el nombre del formulario

    // Verificar si la conexión a la base de datos es válida
    if ($conn) {
        // Preparar la consulta SQL para verificar el email
        $sql = "SELECT id, usuario, contrasena FROM registro WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Asociar el parámetro email con la consulta preparada
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();  // Almacenar los resultados

            // Verificar si existe un usuario con ese correo
            if ($stmt->num_rows > 0) {
                // Asociar los resultados con las variables
                $stmt->bind_result($id, $usuario, $hash_contraseña);
                $stmt->fetch();

                // Verificar si la contraseña ingresada coincide con la cifrada
                if (password_verify($contraseña, $hash_contraseña)) {
                    // Si la contraseña es correcta, iniciar sesión
                    $_SESSION['id'] = $id;
                    $_SESSION['usuario'] = $usuario;

                    echo "Inicio de sesión exitoso. Bienvenido, $usuario.";
                    // Redirigir a la página de inicio o al panel de usuario
                    header("Location: pacientesp.html");
                    exit();  // Asegura que el código se detenga tras la redirección
                } else {
                    // Si la contraseña no coincide
                    echo "La contraseña es incorrecta.";
                }
            } else {
                // Si no se encuentra el usuario con ese email
                echo "No existe una cuenta asociada a este correo.";
            }

            $stmt->close();  // Cerrar la declaración preparada
        } else {
            echo "Error al preparar la consulta: " . $conn->error;
        }

        $conn->close();  // Cerrar la conexión a la base de datos
    } else {
        echo "Error de conexión a la base de datos.";
    }
}
?>
