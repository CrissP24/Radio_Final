<?php 
session_start();
include 'includes/db.php';

// Inicializar variables de error
$errors = array();

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha seleccionado un archivo
    if (!empty($_FILES["archivo"]["name"])) {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $tipo = $_POST['tipo'];
        $creado_por = $_SESSION['usuario_id']; // Suponiendo que tengas una sesión de usuario activa
        
        // Directorio donde se guardarán los archivos multimedia
        $target_dir = "img/";
        $archivo = $target_dir . basename($_FILES["archivo"]["name"]);
        
        // Verificar el tipo de archivo y tamaño
        $fileType = strtolower(pathinfo($archivo,PATHINFO_EXTENSION));
        if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" && $fileType != "mp4") {
            $errors[] = "Solo se permiten archivos de imagen (jpg, jpeg, png, gif) y video (mp4).";
        } elseif ($_FILES["archivo"]["size"] > 5000000) { // 5MB
            $errors[] = "El tamaño máximo permitido para archivos es de 5MB.";
        } else {
            // Mover el archivo al directorio de subida
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo)) {
                // Insertar los datos en la base de datos
                $sql = "INSERT INTO contenido_multimedia (titulo, descripcion, tipo, archivo, creado_por) 
                        VALUES ('$titulo', '$descripcion', '$tipo', '$archivo', $creado_por)";
                if ($conn->query($sql) === TRUE) {
                    echo "El archivo se ha cargado correctamente.";
                } else {
                    $errors[] = "Error al insertar el archivo en la base de datos: " . $conn->error;
                }
            } else {
                $errors[] = "Error al subir el archivo.";
            }
        }
    } else {
        $errors[] = "Por favor, seleccione un archivo para cargar.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Contenido Multimedia - Estación Radial</title>
    <link rel="stylesheet" href="css/estilo.css">
   
</head>
<body>
    <header>
        <h1>Gestión de Contenido Multimedia</h1>
    </header>
    <main>
        <!-- Formulario de carga de archivos -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required><br><br>
            
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea><br><br>
            
            <label for="tipo">Tipo de contenido:</label>
            <select id="tipo" name="tipo" required>
                <option value="imagen">Imagen</option>
                <option value="video">Video</option>
                <option value="noticia">Noticia</option>
            </select><br><br>
            
            <label for="archivo">Seleccionar archivo:</label>
            <input type="file" id="archivo" name="archivo" accept="image/*,video/mp4" required><br><br>
            
            <input type="submit" value="Subir Archivo">
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

