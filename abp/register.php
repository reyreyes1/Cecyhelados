<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'cecyhelados');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña
$address = $_POST['address'];
$cardNumber = $_POST['cardNumber'];
$cvv = $_POST['cvv'];
$cardType = $_POST['cardType'];

// Insertar en la base de datos
$sql = "INSERT INTO users (name, email, password, address, card_number, cvv, card_type)
        VALUES ('$name', '$email', '$password', '$address', '$cardNumber', '$cvv', '$cardType')";

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso";
    header("Location: index.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
