<?php include 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Radio Alfaro 96.1 FM</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Iniciar Sesión</h1>
    </header>
    <main>
        <form action="inicio_sesion.php" method="post">
            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" required><br><br>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required><br><br>
            
            <input type="submit" value="Iniciar Sesión">
        </form>
        
        <?php
        // Procesamiento del formulario de inicio de sesión
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            
            // Consultar la base de datos para verificar las credenciales
            $sql = "SELECT id, contrasena, rol FROM usuarios WHERE correo='$correo'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($contrasena, $row['contrasena'])) {
                    // Iniciar sesión
                    session_start();
                    $_SESSION['usuario_id'] = $row['id'];
                    // Redirigir al usuario a su panel correspondiente (admin o usuario)
                    if ($row['rol'] == 'admin') {
                        header("Location: dashboard_admin.php");
                    } else {
                        header("Location: dashboard_usuario.php");
                    }
                    exit();
                } else {
                    echo "<p>Credenciales inválidas. Por favor, inténtalo de nuevo.</p>";
                }
            } else {
                echo "<p>Usuario no encontrado. Por favor, regístrate primero.</p>";
            }
        }
        ?>
    </main>
    <footer>
    <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
