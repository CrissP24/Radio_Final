<?php include 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Estación Radial</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Registro</h1>
    </header>
    <main>
        <form action="registro.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>
            
            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" required><br><br>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required><br><br>
            
            <label for="confirmar_contrasena">Confirmar Contraseña:</label>
            <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required><br><br>
            
            <input type="submit" value="Registrarse">
        </form>
        
        <?php
        // Procesamiento del formulario de registro
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $confirmar_contrasena = $_POST['confirmar_contrasena'];
            
            // Verificar si las contraseñas coinciden
            if ($contrasena != $confirmar_contrasena) {
                echo "<p>Las contraseñas no coinciden. Por favor, inténtalo de nuevo.</p>";
            } else {
                // Insertar el nuevo usuario en la base de datos
                $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT); // Encriptar la contraseña
                $sql = "INSERT INTO usuarios (nombre, correo, contrasena, rol) VALUES ('$nombre', '$correo', '$hashed_password', 'usuario')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<p>¡Registro exitoso!</p>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        ?>
    </main>
    <footer>
    <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
