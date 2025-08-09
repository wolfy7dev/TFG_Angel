<?php

include_once ('db.php');
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['text']) && isset($_POST['categoria'])) {
    //Verificar si el usuario esta logado que pueda enviar mensajes
    if (!isset($_SESSION['user_id'])) {
        echo '<script>alert("¡Necesitas iniciar sesión para comentar!");</script>';
    } else {
        // Obtener el texto del comentario enviado por el usuario
        $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
        $text = mysqli_real_escape_string($conn, $_POST['text']);
        $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
        $time = date('Y-m-d H:i:s'); //Sacamos la fecha de cuando se mando el mensaje
        $sql = "INSERT INTO comments (user_id, comment_text, comment_time, categoria) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $user_id, $text, $time, $categoria);

        $stmt->execute();
    }
}

function mostrarComentarios($conn, $categoria)
{
    // Consultar los comentarios de la base de datos con el nombre de usuario en lugar del ID
    $sql = "SELECT comments.*, users.username 
            FROM comments 
            INNER JOIN users ON comments.user_id = users.id
            WHERE categoria = ?
            ORDER BY comment_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $categoria);
    $stmt->execute();
    $result = $stmt->get_result();
    // Verificar si hay comentarios
    if ($result->num_rows > 0) {
        // Mostrar los comentarios
        echo '<div class="chat-messages">';
        while ($row = $result->fetch_assoc()) {
            echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
            crossorigin="anonymous" referrerpolicy="no-referrer" />';
            echo '<div class="chat-bubble">';
            echo '<div class="user-info">';
            echo '<i class="fa-regular fa-user"></i> ' . $row['username'];
            echo '</div>';
            echo '<div class="message">' . $row['comment_text'] . '</div>';
            echo '<div class="time">' . $row['comment_time'] . '</div>';
            echo '</div>';
        }
        echo '</div>'; // Cerrar chat-messages
    } else {
        echo "No hay comentarios aún.";
    }
}


