<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'cecyhelados');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejar actualización de datos si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    // Obtener datos del formulario
    $name = $_POST['name'];
    $address = $_POST['address'];
    $cardNumber = $_POST['cardNumber'];
    $cvv = $_POST['cvv'];
    $cardType = $_POST['cardType'];

    // Actualizar en la base de datos
    $sql = "UPDATE users SET name='$name', address='$address', card_number='$cardNumber', cvv='$cvv', card_type='$cardType' WHERE id=" . $user['id'];

    if ($conn->query($sql) === TRUE) {
        echo "Perfil actualizado";
        // Actualizar datos en sesión
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['address'] = $address;
        $_SESSION['user']['card_number'] = $cardNumber;
        $_SESSION['user']['cvv'] = $cvv;
        $_SESSION['user']['card_type'] = $cardType;
    } else {
        echo "Error al actualizar el perfil: " . $conn->error;
    }
}

// Manejar la eliminación del usuario si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $sql_delete = "DELETE FROM users WHERE id=" . $user['id'];

    if ($conn->query($sql_delete) === TRUE) {
        // Eliminar la sesión y redirigir a la página de inicio
        session_unset();
        session_destroy();
        header("Location: index.html");
        exit();
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }
}

// Obtener los datos del usuario para mostrar en el formulario
$sql_select = "SELECT * FROM users WHERE id=" . $user['id'];
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Guardar datos en la sesión actual
    $_SESSION['user'] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            color: #26c6da;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            background-color: #26a69a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .form-group button:hover {
            background-color: #00796b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Perfil de Usuario</h2>
        <form action="profile.php" method="POST">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cardNumber">Número de Tarjeta:</label>
                <input type="text" id="cardNumber" name="cardNumber" maxlength="16" value="<?php echo $user['card_number']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" maxlength="4" value="<?php echo $user['cvv']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cardType">Tipo de Tarjeta:</label>
                <select id="cardType" name="cardType" required>
                    <option value="Visa" <?php if ($user['card_type'] == 'Visa') echo 'selected'; ?>>Visa</option>
                    <option value="MasterCard" <?php if ($user['card_type'] == 'MasterCard') echo 'selected'; ?>>MasterCard</option>
                    <option value="Amex" <?php if ($user['card_type'] == 'Amex') echo 'selected'; ?>>Amex</option>
                    <option value="Discover" <?php if ($user['card_type'] == 'Discover') echo 'selected'; ?>>Discover</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="update_profile">Guardar Cambios</button>
            </div>
        </form>
        
        <!-- Formulario para eliminar usuario -->
        <form action="profile.php" method="POST">
            <div class="form-group">
                <button type="submit" name="delete_user" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?')">Eliminar Cuenta</button>
            </div>
        </form>

        <!-- Botón para cerrar sesión y enlace para regresar a la página de inicio -->
        <form action="logout.php" method="POST">
            <div class="form-group">
                <button type="submit">Cerrar Sesión</button>
            </div>
        </form>
        <div>
            <a href="index.html">
                <button style="padding: 10px 20px; background-color: #e68900; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Regresar a la página de inicio 😸 
                </button>
            </a>
        </div>
    </div>
</body>
</html>
