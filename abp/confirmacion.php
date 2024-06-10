<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: loging.html");
    exit();
}

$user = $_SESSION['user'];
$cart = json_decode($_POST['cartData'], true); // Obtener los datos del carrito de compras desde el formulario

// Aquí podrías procesar el pago y almacenar los detalles de la compra en la base de datos

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pago</title>
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
            text-align: center;
        }

        .container h2 {
            color: #26c6da;
        }

        .ticket {
            text-align: left;
            margin-top: 20px;
        }

        .alert-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: scaleAnimation 0.5s ease-in-out;
        }
        .alert-box img {
            max-width: 100px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        @keyframes scaleAnimation {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
                opacity: 1;
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>¡Gracias por tu compra!</h2>
        <div class="ticket">
            <p><strong>Nombre:</strong> <?php echo $user['name']; ?></p>
            <p><strong>Dirección:</strong> <?php echo $user['address']; ?></p>
            <p><strong>Número de Tarjeta:</strong> **** **** **** <?php echo substr($user['card_number'], -4); ?></p>
            <h3>Detalles del Pedido:</h3>
            <ul>
                <?php foreach ($cart as $item): ?>
                    <li><?php echo $item['name'] . ' - ' . $item['quantity'] . ' unidad(es) - $' . ($item['price'] * $item['quantity']); ?></li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Total:</strong> $<?php echo number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart)), 2); ?></p>
        </div>
    </div>
    <script>
        function showAlert(message, imageUrl) {
            const alertBox = document.createElement('div');
            alertBox.classList.add('alert-box');
            
            if (imageUrl) {
                const img = document.createElement('img');
                img.src = "cecyto.jpg";
                alertBox.appendChild(img);
            }
            
            const p = document.createElement('p');
            p.textContent = message;
            alertBox.appendChild(p);
            
            document.body.appendChild(alertBox);

            return alertBox;
        }

        function removeAlert(alertBox) {
            alertBox.remove();
        }

        window.onload = function() {
            const firstAlert = showAlert("¡Gracias por tu compra!", "cecyto.jpg");

            setTimeout(() => {
                removeAlert(firstAlert);
                const secondAlert = showAlert("Regresando al menú");
                
                setTimeout(() => {
                    removeAlert(secondAlert);
                    window.location.href = "index.html";
                }, 5000); // Espera 5 segundos antes de redirigir
            }, 5000); // Espera 5 segundos antes de mostrar la segunda alerta
        };
       
    </script>
 <audio autoplay loop>
        <source src="feli.mp3" type="audio/mpeg">
        Tu navegador no soporta la reproducción de audio.
    </audio>
</body>
</html>
