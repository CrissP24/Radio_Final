<?php include 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Contenido - Estación Radial</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Gestión de Contenido</h1>
        <nav>
            <ul>
                <li><a href="panel_admin.php">Inicio</a></li>
                <li><a href="estadisticas.php">Estadísticas</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li> <!-- Agrega un archivo logout.php para cerrar sesión -->
            </ul>
        </nav>
    </header>
    <main>
        <!-- Formulario para agregar programa -->
        <h2>Agregar Programa</h2>
        <form action="agregar_programa.php" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required><br><br>
            
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br><br>
            
            <label for="hora_emision">Hora de Emisión:</label>
            <input type="time" id="hora_emision" name="hora_emision" required><br><br>
            
            <label for="duracion">Duración (en minutos):</label>
            <input type="number" id="duracion" name="duracion" required><br><br>
            
            <input type="submit" value="Agregar Programa">
        </form>
        
        <!-- Lista de programas existentes -->
        <h2>Programas</h2>
        <ul>
            <?php
            // Obtener programas de la base de datos
            $sql = "SELECT * FROM programas";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Mostrar cada programa como un elemento de la lista
                while($row = $result->fetch_assoc()) {
                    echo "<li><strong>Título:</strong> " . $row["titulo"] . " - <strong>Descripción:</strong> " . $row["descripcion"] . "</li>";
                }
            } else {
                echo "<li>No hay programas disponibles.</li>";
            }
            ?>
        </ul>
    </main>
    <footer>
    <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
    </footer>
</body>
</html>


