<?php 
session_start();
include 'includes/db.php';

// Lógica para agregar nuevo patrocinio
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_patrocinio'])) {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $duracion = $_POST['duracion'];

    // Insertar el nuevo patrocinio en la base de datos
    $sql = "INSERT INTO patrocinios (nombre, descripcion, duracion) VALUES ('$nombre', '$descripcion', '$duracion')";
    if ($conn->query($sql) === TRUE) {
        header("Location: gestion_patrocinios.php?status=success");
        exit();
    } else {
        header("Location: gestion_patrocinios.php?status=error");
        exit();
    }
}

// Lógica para actualizar patrocinio
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_patrocinio'])) {
    // Recuperar los datos del formulario
    $id_patrocinio = $_POST['id_patrocinio'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nueva_descripcion = $_POST['nueva_descripcion'];
    $nueva_duracion = $_POST['nueva_duracion'];

    // Construir la consulta SQL para actualizar el patrocinio
    $sql = "UPDATE patrocinios SET ";
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
    $sql .= " WHERE id = '$id_patrocinio'";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        header("Location: gestion_patrocinios.php?status=success");
        exit();
    } else {
        header("Location: gestion_patrocinios.php?status=error");
        exit();
    }
}

// Lógica para eliminar patrocinio
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_patrocinio'])) {
    // Recuperar el ID del patrocinio a eliminar
    $id_patrocinio_eliminar = $_POST['id_patrocinio_eliminar'];

    // Construir la consulta SQL para eliminar el patrocinio
    $sql = "DELETE FROM patrocinios WHERE id = '$id_patrocinio_eliminar'";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        header("Location: gestion_patrocinios.php?status=success");
        exit();
    } else {
        header("Location: gestion_patrocinios.php?status=error");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Patrocinios - Estación Radial</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Gestión de Patrocinios</h1>
    </header>
    <main>
        <section>
            <h2>Crear Nuevo Patrocinio</h2>
            <!-- Formulario para agregar nuevo patrocinio -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="agregar_patrocinio" value="1">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br><br>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea><br><br>
                <label for="duracion">Duración (en segundos):</label>
                <input type="number" id="duracion" name="duracion" required><br><br>
                <input type="submit" value="Agregar Patrocinio">
            </form>
        </section>

        <section>
            <h2>Actualizar Patrocinio</h2>
            <!-- Formulario para actualizar patrocinio -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="actualizar_patrocinio" value="1">
                <label for="id_patrocinio">Seleccione el Patrocinio:</label>
                <select id="id_patrocinio" name="id_patrocinio" required>
                    <?php
                    // Recuperar los patrocinios desde la base de datos
                    $sql = "SELECT id, nombre FROM patrocinios";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select><br><br>
                <!-- Campos para actualizar el patrocinio -->
                <label for="nuevo_nombre">Nuevo Nombre:</label>
                <input type="text" id="nuevo_nombre" name="nuevo_nombre"><br><br>
                <label for="nueva_descripcion">Nueva Descripción:</label>
                <textarea id="nueva_descripcion" name="nueva_descripcion"></textarea><br><br>
                <label for="nueva_duracion">Nueva Duración (en segundos):</label>
                <input type="number" id="nueva_duracion" name="nueva_duracion"><br><br>
                <input type="submit" value="Actualizar Patrocinio">
            </form>
        </section>

        <section>
            <h2>Eliminar Patrocinio</h2>
            <!-- Formulario para eliminar patrocinio -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="eliminar_patrocinio" value="1">
                <label for="id_patrocinio_eliminar">Seleccione el Patrocinio a Eliminar:</label>
                <select id="id_patrocinio_eliminar" name="id_patrocinio_eliminar" required>
                    <?php
                    // Recuperar los patrocinios desde la base de datos
                    $sql = "SELECT id, nombre FROM patrocinios";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Eliminar Patrocinio">
            </form>
        </section>

        <section>
            <h2>Patrocinios Actuales</h2>
            <!-- Lista de patrocinios actuales -->
            <?php
            // Recuperar y mostrar los patrocinios actuales desde la base de datos
            $sql = "SELECT id, nombre, descripcion, duracion FROM patrocinios";
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
                echo "No hay patrocinios disponibles.";
            }
            ?>
        </section>
    </main>
    <footer>
    <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
