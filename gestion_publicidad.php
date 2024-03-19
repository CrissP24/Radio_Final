<?php 
include 'includes/db.php';

// Lógica para agregar nueva publicidad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_publicidad'])) {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $duracion = $_POST['duracion'];

    // Insertar la nueva publicidad en la base de datos
    $sql = "INSERT INTO publicidad (nombre, descripcion, duracion) VALUES ('$nombre', '$descripcion', '$duracion')";
    if ($conn->query($sql) === TRUE) {
        header("Location: gestion_publicidad.php?status=success");
        exit();
    } else {
        header("Location: gestion_publicidad.php?status=error");
        exit();
    }
}

// Lógica para actualizar publicidad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_publicidad'])) {
    // Recuperar los datos del formulario
    $id_publicidad = $_POST['id_publicidad'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nueva_descripcion = $_POST['nueva_descripcion'];
    $nueva_duracion = $_POST['nueva_duracion'];

    // Construir la consulta SQL para actualizar la publicidad
    $sql = "UPDATE publicidad SET ";
    if (!empty($nuevo_nombre)) {
        $sql .= "nombre = '$nuevo_nombre', ";
    }
    if (!empty($nueva_descripcion)) {
        $sql .= "descripcion = '$nueva_descripcion', ";
    }
    if (!empty($nueva_duracion)) {
        $sql .= "duracion = '$nueva_duracion', ";
    }
    // Eliminar la coma final y agregar la condición WHERE
    $sql = rtrim($sql, ", ");
    $sql .= " WHERE id = '$id_publicidad'";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        header("Location: gestion_publicidad.php?status=success");
        exit();
    } else {
        header("Location: gestion_publicidad.php?status=error");
        exit();
    }
}

// Lógica para eliminar publicidad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_publicidad'])) {
    // Recuperar el ID de la publicidad a eliminar
    $id_publicidad_eliminar = $_POST['id_publicidad_eliminar'];

    // Construir la consulta SQL para eliminar la publicidad
    $sql = "DELETE FROM publicidad WHERE id = '$id_publicidad_eliminar'";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        header("Location: gestion_publicidad.php?status=success");
        exit();
    } else {
        header("Location: gestion_publicidad.php?status=error");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Publicidad - Estación Radial</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Gestión de Publicidad</h1>
    </header>
    <main>
        <section>
            <h2>Crear Nueva Publicidad</h2>
            <!-- Formulario para agregar nueva publicidad -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="agregar_publicidad" value="1">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br><br>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea><br><br>
                <label for="duracion">Duración (en segundos):</label>
                <input type="number" id="duracion" name="duracion" required><br><br>
                <input type="submit" value="Agregar Publicidad">
            </form>
        </section>

        <section>
            <h2>Actualizar Publicidad</h2>
            <!-- Formulario para actualizar publicidad -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="actualizar_publicidad" value="1">
                <label for="id_publicidad">Seleccione la Publicidad:</label>
                <select id="id_publicidad" name="id_publicidad" required>
                    <?php
                    // Recuperar las publicidades desde la base de datos
                    $sql = "SELECT id, nombre FROM publicidad";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select><br><br>
                <!-- Campos para actualizar la publicidad -->
                <label for="nuevo_nombre">Nuevo Nombre:</label>
                <input type="text" id="nuevo_nombre" name="nuevo_nombre"><br><br>
                <label for="nueva_descripcion">Nueva Descripción:</label>
                <textarea id="nueva_descripcion" name="nueva_descripcion"></textarea><br><br>
                <label for="nueva_duracion">Nueva Duración (en segundos):</label>
                <input type="number" id="nueva_duracion" name="nueva_duracion"><br><br>
                <input type="submit" value="Actualizar Publicidad">
            </form>
        </section>

        <section>
            <h2>Eliminar Publicidad</h2>
            <!-- Formulario para eliminar publicidad -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="eliminar_publicidad" value="1">
                <label for="id_publicidad_eliminar">Seleccione la Publicidad a Eliminar:</label>
                <select id="id_publicidad_eliminar" name="id_publicidad_eliminar" required>
                    <?php
                    // Recuperar las publicidades desde la base de datos
                    $sql = "SELECT id, nombre FROM publicidad";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Eliminar Publicidad">
            </form>
        </section>

        <section>
            <h2>Publicidades Actuales</h2>
            <!-- Aquí se muestra la lista de publicidades actuales -->
            <?php
            // Recuperar y mostrar las publicidades actuales desde la base de datos
            $sql = "SELECT id, nombre, descripcion, duracion FROM publicidad";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div>";
                    echo "<h3>" . $row['nombre'] . "</h3>";
                    echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
                    echo "<p><strong>Duración:</strong> " . $row['duracion'] . " segundos</p>";
                    echo "</div>";
                }
            } else {
                echo "No hay publicidades disponibles.";
            }
            ?>
        </section>
    </main>
    <footer>
    <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
