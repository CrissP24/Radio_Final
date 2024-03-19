<?php

session_start();
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id']; // Suponiendo que tengas una sesión de usuario activa
    $noticia_id = $_POST['noticia_id'];
    $comentario = $_POST['comentario'];

    // Insertar el comentario en la base de datos
    $sql = "INSERT INTO comentarios_noticias (usuario_id, noticia_id, comentario) VALUES ('$usuario_id', '$noticia_id', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        echo "Comentario enviado correctamente.";
    } else {
        echo "Error al enviar el comentario: " . $conn->error;
    }
}
?>
