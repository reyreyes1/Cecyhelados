<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pago</title>
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
    <script>
        function getCartData() {
            return JSON.parse(localStorage.getItem('cart')) || [];
        }

        function appendCartDataToForm() {
            const cartData = getCartData();
            const cartDataInput = document.createElement('input');
            cartDataInput.type = 'hidden';
            cartDataInput.name = 'cartData';
            cartDataInput.value = JSON.stringify(cartData);

            const form = document.querySelector('form');
            form.appendChild(cartDataInput);
        }

        window.onload = appendCartDataToForm;
    </script>
</head>
<body>
    <div class="container">
        <h2>Información de Pago</h2>
        <form action="confirmacion.php" method="POST">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="cardNumber">Número de Tarjeta:</label>
                <input type="text" id="cardNumber" name="cardNumber" maxlength="16" value="<?php echo $user['card_number']; ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" maxlength="4" value="<?php echo $user['cvv']; ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="cardType">Tipo de Tarjeta:</label>
                <input type="text" id="cardType" name="cardType" value="<?php echo $user['card_type']; ?>" required readonly>
            </div>
            <div class="form-group">
                <button type="submit">Confirmar Pago</button>
            </div>
        </form>
    </div>
</body>
</html>
