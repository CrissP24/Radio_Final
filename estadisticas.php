<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas - Estación Radial</title>
   
    <!-- Agrega las bibliotecas necesarias para mostrar gráficos, por ejemplo, Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <h1>Estadísticas</h1>
        <nav>
            <ul>
            <li><a href="dashboard_admin.php">Inicio</a></li>
                <li><a href="dashboard_admin.php">Gestión de Contenido</a></li>
                <li><a href="dashboard_admin.php">Estadísticas</a></li>
                <li><a href="dashboard_admin.php">Noticias</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li> <!-- Agrega un archivo logout.php para cerrar sesión -->
            </ul>
        </nav>
    </header>
    <main>
        <!-- Contenido de las estadísticas -->
        <section>
            <h2>Comentarios por Tipo de Noticia</h2>
            <canvas id="comentariosPorTipo"></canvas>
        </section>
    </main>
    <footer>
    <p>&copy; 2024 UPOCAM Radio Alfaro 91.6 FM. Todos los derechos reservados.</p>
    </footer>

    <script>
        // Consulta SQL para obtener estadísticas de comentarios por tipo de noticia
        <?php
        $sql = "SELECT cm.tipo, COUNT(cn.id) as cantidad FROM contenido_multimedia cm LEFT JOIN comentarios_noticias cn ON cm.id = cn.noticia_id GROUP BY cm.tipo";
        $result = $conn->query($sql);

        $tipos = [];
        $cantidades = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tipos[] = $row['tipo'];
                $cantidades[] = $row['cantidad'];
            }
        }
        ?>

        // Datos para el gráfico de comentarios por tipo de noticia
        var ctx = document.getElementById('comentariosPorTipo').getContext('2d');
        var comentariosPorTipo = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($tipos); ?>,
                datasets: [{
                    label: 'Cantidad de Comentarios',
                    data: <?php echo json_encode($cantidades); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>
