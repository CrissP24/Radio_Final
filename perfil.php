<?php 
include 'includes/db.php'; 

// Verificar el tipo de usuario
if ($_SESSION['rol'] === 'admin') {
    // Contenido para administradores
    $contenido = "<h2>Bienvenido Administrador</h2>";
    // Puedes agregar más contenido específico para administradores aquí
} else {
    // Contenido para usuarios comunes
    $contenido = "<h2>Bienvenido Usuario</h2>";
    // Puedes agregar más contenido específico para usuarios comunes aquí
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Estación Radial</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Perfil</h1>
    </header>
    <main>
        <!-- Contenido del perfil -->
        <?php echo $contenido; ?>
    </main>
    <footer>
    <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
