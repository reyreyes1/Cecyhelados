<?php
session_start();

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'cecyhelados');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Consultar en la base de datos
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verificar la contraseña
    if (password_verify($password, $user['password'])) {
        // Guardar datos en sesión
        $_SESSION['user'] = $user;
        header("Location: index.html");
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Correo no registrado";
}

$conn->close();
?>
