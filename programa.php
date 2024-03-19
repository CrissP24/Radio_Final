<?php 
include 'includes/db.php';

// Consultar la base de datos para obtener los programas agregados por el administrador
$sql = "SELECT * FROM programas WHERE creado_por = (SELECT id FROM usuarios WHERE rol = 'admin')";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas - Estación Radial</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Programas</h1>
    </header>
    <main>
        <?php 
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<h2>" . $row['titulo'] . "</h2>";
                echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
                echo "<p><strong>Hora de Emisión:</strong> " . $row['hora_emision'] . "</p>";
                echo "<p><strong>Duración:</strong> " . $row['duracion'] . " minutos</p>";
                // Puedes agregar más detalles del programa aquí
                echo "</div>";
            }
        } else {
            echo "No se encontraron programas agregados por el administrador.";
        }
        ?>
    </main>
    <footer>
    <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
