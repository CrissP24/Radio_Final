<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - UPOCAM Radio Alfaro 91.6 FM</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        /* Personalización de animaciones */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Estilos personalizados */
        .jumbotron {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 100px 0;
            margin-bottom: 0;
        }

        .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .feature {
            margin-top: 50px;
            padding: 30px;
            border-radius: 10px;
            background-color: #333;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 3em;
            color: #fff;
            animation: pulse 2s infinite alternate;
        }

        .feature-title {
            margin-top: 20px;
            font-size: 1.5em;
            color: #fff;
        }

        .feature-description {
            margin-top: 20px;
            color: #ccc;
        }

        .footer {
            background-color: #000;
            color: #fff;
            padding: 20px 0;
        }

        /* Estilos personalizados para los botones */
        .btn-primary-custom {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            border-color: #6c757d;
            transition: all 0.3s ease;
        }

        .btn-secondary-custom:hover {
            background-color: #545b62;
            border-color: #545b62;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="img/UPOCAM.png" alt="Logo de UPOCAM Radio Alfaro" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary-custom animate__animated animate__fadeInLeft" href="inicio_sesion.php">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-secondary-custom animate__animated animate__fadeInRight" href="registro.php">Registrarse</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Bienvenid@ a Radio Alfaro 91.6 FM</h1>
            <p class="lead">La mejor música y entretenimiento te espera aquí en Jipijapa.</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="feature">
                    <i class="fas fa-microphone-alt feature-icon"></i>
                    <h2 class="feature-title">Programación Variada</h2>
                    <p class="feature-description">Disfruta de una amplia gama de programas, desde música hasta programas de entrevistas y noticias.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <i class="fas fa-music feature-icon"></i>
                    <h2 class="feature-title">Música Sin Parar</h2>
                    <p class="feature-description">Sintoniza nuestra estación las 24 horas del día para disfrutar de música de todos los géneros.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <i class="fas fa-broadcast-tower feature-icon"></i>
                    <h2 class="feature-title">Cobertura Amplia</h2>
                    <p class="feature-description">Transmitimos en toda la región de Jipijapa y sus alrededores para que nunca te pierdas nuestras emisiones.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-center">
        <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
