<?php
session_start();
include 'includes/db.php';

// Inicializar variables de error
$errors = array();

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha seleccionado un archivo
    if (!empty($_FILES["imagen"]["name"])) {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $hora_emision = $_POST['hora_emision'];
        $duracion = $_POST['duracion'];
        $creado_por = $_SESSION['usuario_id']; // Suponiendo que tengas una sesión de usuario activa
        
        // Directorio donde se guardarán las imágenes de los programas
        $target_dir = "img/";
        $imagen = $target_dir . basename($_FILES["imagen"]["name"]);
        
        // Verificar el tipo de archivo y tamaño
        $fileType = strtolower(pathinfo($imagen,PATHINFO_EXTENSION));
        if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
            $errors[] = "Solo se permiten archivos de imagen (jpg, jpeg, png, gif).";
        } elseif ($_FILES["imagen"]["size"] > 5000000) { // 5MB
            $errors[] = "El tamaño máximo permitido para archivos es de 5MB.";
        } else {
            // Mover la imagen al directorio de subida
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen)) {
                // Insertar los datos en la base de datos
                $sql = "INSERT INTO programas (titulo, descripcion, hora_emision, duracion, imagen, creado_por) 
                        VALUES ('$titulo', '$descripcion', '$hora_emision', '$duracion', '$imagen', $creado_por)";
                if ($conn->query($sql) === TRUE) {
                    echo "El programa se ha agregado correctamente.";
                } else {
                    $errors[] = "Error al insertar el programa en la base de datos: " . $conn->error;
                }
            } else {
                $errors[] = "Error al subir la imagen del programa.";
            }
        }
    } else {
        $errors[] = "Por favor, seleccione una imagen para el programa.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Programa - Estación Radial</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Agregar Programa</h1>
    </header>
    <main>
        <!-- Formulario de carga de programas -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required><br><br>
            
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea><br><br>
            
            <label for="hora_emision">Hora de Emisión:</label>
            <input type="time" id="hora_emision" name="hora_emision" required><br><br>
            
            <label for="duracion">Duración (minutos):</label>
            <input type="number" id="duracion" name="duracion" required><br><br>
            
            <label for="imagen">Seleccionar imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>
            
            <input type="submit" value="Agregar Programa">
        </form>
        
        <!-- Mostrar errores -->
        <?php 
        if (!empty($errors)) {
            echo "<div class='errors'>";
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";
        }
        ?>
    </main>
    <footer>
    <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
