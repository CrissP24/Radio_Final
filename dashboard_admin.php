<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - Estación Radial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        nav ul li a:hover {
            color: #ccc;
        }
        .fa {
            margin-right: 5px;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1><i class="fas fa-cogs"></i> Panel de Administrador</h1>
        <nav>
            <ul>
                <li><a href="dashboard_admin.php"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h2>Gestión de Contenido</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Programas</h5>
                        <p class="card-text">Administra los programas de radio.</p>
                        <a href="gestion_programas.php" class="btn btn-primary"><i class="fas fa-list"></i> Ir a Gestión de Programas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Contenido Multimedia</h5>
                        <p class="card-text">Administra contenido multimedia.</p>
                        <a href="gestion_contenido_multimedia.php" class="btn btn-primary"><i class="fas fa-image"></i> Ir a Gestión de Contenido Multimedia</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Publicidad</h5>
                        <p class="card-text">Administra la publicidad de la estación radial.</p>
                        <a href="gestion_publicidad.php" class="btn btn-primary"><i class="fas fa-ad"></i> Ir a Gestión de Publicidad</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Patrocinios</h5>
                        <p class="card-text">Administra los patrocinios de la estación radial.</p>
                        <a href="gestion_patrocinios.php" class="btn btn-primary"><i class="fas fa-handshake"></i> Ir a Gestión de Patrocinios</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Noticias</h5>
                        <p class="card-text">Administra las noticias de la estación radial.</p>
                        <a href="noticias.php" class="btn btn-primary"><i class="fas fa-newspaper"></i> Ir a Gestión de Noticias</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Estadísticas</h5>
                        <p class="card-text">Revisa tus estadísticas.</p>
                        <a href="estadisticas.php" class="btn btn-primary"><i class="fas fa-chart-bar"></i> Ver Estadísticas</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container text-center">
            <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
