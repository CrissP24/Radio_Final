<?php
session_start();
include 'includes/db.php';

// Consultar la base de datos para obtener la información del usuario actual
$user_id = 1; // Esto es solo un ejemplo, deberías obtener el ID del usuario de alguna forma (a través de la sesión, por ejemplo)
$sql_user = "SELECT * FROM usuarios WHERE id = $user_id";
$result_user = $conn->query($sql_user);
if ($result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
}

// Consultar la base de datos para obtener los programas agregados por el administrador
$sql_programs = "SELECT * FROM programas WHERE creado_por = (SELECT id FROM usuarios WHERE rol = 'admin')";
$result_programs = $conn->query($sql_programs);

// Consultar la base de datos para obtener las noticias
$sql_news = "SELECT * FROM noticias";
$result_news = $conn->query($sql_news);

// Consultar la base de datos para obtener el contenido multimedia
$sql_multimedia = "SELECT * FROM contenido_multimedia";
$result_multimedia = $conn->query($sql_multimedia);

// Consultar la base de datos para obtener la publicidad
$sql_advertising = "SELECT * FROM publicidad";
$result_advertising = $conn->query($sql_advertising);

// Consultar la base de datos para obtener los patrocinios
$sql_sponsorships = "SELECT * FROM patrocinios";
$result_sponsorships = $conn->query($sql_sponsorships);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPOCAM - Radio Alfaro 91.6 FM</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Font Roboto para un aspecto más moderno -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
/* Estilos para el cuerpo y la tipografía */
body {
    font-family: 'Roboto', sans-serif;
}

/* Estilos para el encabezado */
.header {
    background-color: #292c36;
    color: #ffffff;
    padding: 20px;
    text-align: center;
}

.header h1 {
    font-size: 32px;
    margin-bottom: 20px;
}

/* Estilos para el slidebar */
.slidebar {
    background-color: #1f2129;
    padding: 20px;
    color: #ffffff;
    position: fixed;
    top: 0;
    left: 0; /* Slidebar estático */
    height: 100vh;
    width: 250px;
    z-index: 1000; /* Asegurar que esté por encima del contenido */
}

.slidebar h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

.slidebar p {
    font-size: 16px;
    margin-bottom: 10px;
}

/* Estilos para el contenido principal */
.main-content {
    padding: 20px;
    margin-left: 250px; /* Espacio para el slidebar */
}

.main-content header {
    background-color: #292c36;
    color: #ffffff;
    padding: 20px;
    text-align: center;
}

.main-content header h1 {
    font-size: 32px;
    margin-bottom: 20px;
}

.main-content main {
    margin-top: 20px;
}

/* Estilos para las secciones */
.main-content section {
    margin-bottom: 40px;
}

.main-content h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

.main-content h3 {
    font-size: 20px;
    margin-bottom: 10px;
}

.main-content p {
    font-size: 16px;
    margin-bottom: 10px;
}

.main-content img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.main-content form {
    margin-top: 10px;
}

.main-content textarea {
    width: 100%;
    height: 100px;
    margin-bottom: 10px;
}

.main-content button {
    background-color: #007bff;
    color: #ffffff;
    border: none;
    padding: 8px 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.main-content button:hover {
    background-color: #0056b3;
}

/* Estilos para el pie de página */
.footer {
    background-color: #1f2129;
    color: #ffffff;
    padding: 20px;
    text-align: center;
}


    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Slidebar -->
            <div class="slidebar" id="slidebar">
                <h2>Perfil de <?php echo $user_data['nombre']; ?></h2>
                <p><strong>Nombre:</strong> <?php echo $user_data['nombre']; ?></p>
                <p><strong>Correo Electrónico:</strong> <?php echo $user_data['correo']; ?></p>
                <!-- Agrega más detalles del usuario si es necesario -->
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
            <!-- Icono de perfil -->
            <div class="profile">
                <button onclick="toggleSlidebar()"><i class="fas fa-user"></i></button>
            </div>
            <!-- Contenido principal -->
            <div class="col-md-12 main-content">
                <header class="header">
                    <h1>UPOCAM - Radio Alfaro 91.6 FM - Bienvenido, <?php echo $user_data['nombre']; ?></h1>
                </header>
                <main>
                    <section>
                        <h2>Programas Agregados por el Administrador</h2>
                        <?php 
                        if ($result_programs->num_rows > 0) {
                            while ($row = $result_programs->fetch_assoc()) {
                                echo "<div>";
                                echo "<h3>" . $row['titulo'] . "</h3>";
                                echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
                                echo "<p><strong>Hora de Emisión:</strong> " . $row['hora_emision'] . "</p>";
                                echo "<p><strong>Duración:</strong> " . $row['duracion'] . " minutos</p>";
                                echo "<img src='" . $row['imagen'] . "' alt='Imagen del programa'>";
                                // Puedes agregar más detalles del programa aquí
                                echo "</div>";
                            }
                        } else {
                            echo "No se encontraron programas agregados por el administrador.";
                        }
                        ?>
                    </section>
                    <section>
                        <h2>Noticias</h2>
                        <?php 
                        if ($result_news->num_rows > 0) {
                            while ($row = $result_news->fetch_assoc()) {
                                echo "<div>";
                                echo "<h3>" . $row['titulo'] . "</h3>";
                                echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
                                echo "<p><strong>Categoría:</strong> " . $row['categoria_id'] . "</p>";
                                echo "<img src='" . $row['imagen'] . "' alt='Imagen de la noticia'>";
                                // Aquí puedes agregar la funcionalidad para que el usuario emita comentarios sobre las noticias
                                echo "<form action='emitir_comentario.php' method='post'>";
                                echo "<input type='hidden' name='noticia_id' value='" . $row['id'] . "'>";
                                echo "<textarea name='comentario' placeholder='Escribe tu comentario aquí'></textarea>";
                                echo "<button type='submit'>Enviar Comentario</button>";
                                echo "</form>";
                                echo "</div>";
                            }
                        } else {
                            echo "No se encontraron noticias.";
                        }
                        ?>
                    </section>
                    <section>
                        <h2>Contenido Multimedia</h2>
                        <?php 
                        if ($result_multimedia->num_rows > 0) {
                            while ($row = $result_multimedia->fetch_assoc()) {
                                echo "<div>";
                                echo "<h3>" . $row['titulo'] . "</h3>";
                                echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
                                echo "<p><strong>Tipo:</strong> " . $row['tipo'] . "</p>";
                                echo "<img src='" . $row['archivo'] . "' alt='Archivo Multimedia'>";
                                // Aquí puedes agregar más detalles del contenido multimedia si es necesario
                                echo "</div>";
                            }
                        } else {
                            echo "No se encontró contenido multimedia.";
                        }
                        ?>
                    </section>
                    <section>
                        <h2>Publicidad</h2>
                        <?php 
                        if ($result_advertising->num_rows > 0) {
                            while ($row = $result_advertising->fetch_assoc()) {
                                echo "<div>";
                                echo "<h3>" . $row['titulo'] . "</h3>";
                                // Agrega más detalles de la publicidad si es necesario
                                echo "</div>";
                            }
                        } else {
                            echo "No se encontró publicidad.";
                        }
                        ?>
                    </section>
                    <section>
                        <h2>Patrocinios</h2>
                        <?php 
                        if ($result_sponsorships->num_rows > 0) {
                            while ($row = $result_sponsorships->fetch_assoc()) {
                                echo "<div>";
                                echo "<h3>" . $row['nombre'] . "</h3>";
                                // Agrega más detalles de los patrocinios si es necesario
                                echo "</div>";
                            }
                        } else {
                            echo "No se encontraron patrocinios.";
                        }
                        ?>
                    </section>
                </main>
                <footer class="footer">
                    <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
                </footer>
            </div>
        </div>
    </div>

    <!-- Bootstrap y jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function toggleSlidebar() {
        var slidebar = document.getElementById('slidebar');
        slidebar.style.left = "00px"; // Asegura que el slidebar esté siempre visible
    }
</script>

</body>
</html>
