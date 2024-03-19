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
        $tipo = $_POST['tipo'];
        $categoria_id = $_POST['categoria'];
        $creado_por = $_SESSION['usuario_id']; // Suponiendo que tengas una sesión de usuario activa
        
        // Directorio donde se guardarán las imágenes de las noticias
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
                $sql = "INSERT INTO noticias (titulo, descripcion, imagen, tipo, categoria_id, creado_por) 
                        VALUES ('$titulo', '$descripcion', '$imagen', '$tipo', '$categoria_id', '$creado_por')";
                if ($conn->query($sql) === TRUE) {
                    echo "La noticia se ha agregado correctamente.";
                } else {
                    $errors[] = "Error al insertar la noticia en la base de datos: " . $conn->error;
                }
            } else {
                $errors[] = "Error al subir la imagen de la noticia.";
            }
        }
    } else {
        $errors[] = "Por favor, seleccione una imagen para la noticia.";
    }
}

// Obtener las categorías de la base de datos
$sql_categorias = "SELECT id, nombre FROM categorias";
$result_categorias = $conn->query($sql_categorias);
$categorias = array();
if ($result_categorias->num_rows > 0) {
    while ($row = $result_categorias->fetch_assoc()) {
        $categorias[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Noticia - Estación Radial</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Agregar Noticia</h1>
    </header>
    <main>
        <!-- Formulario de carga de noticias -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required><br><br>
            
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea><br><br>
            
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="img/*" required><br><br>
            
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="noticia">Noticia</option>
                <option value="evento">Evento</option>
                <option value="promoción">Promoción</option>
            </select><br><br>
            
            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
                <?php 
                foreach ($categorias as $categoria) {
                    echo "<option value='" . $categoria['id'] . "'>" . $categoria['nombre'] . "</option>";
                }
                ?>
            </select><br><br>
            
            <input type="submit" value="Agregar Noticia">
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
