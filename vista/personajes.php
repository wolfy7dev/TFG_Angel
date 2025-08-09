<?php
include_once ('cajacomentarios/comentarios.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Personajes</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="stbuscador.css" />
  <link rel="stylesheet" href="cajacomentarios/comentarios.css">
  <script type="text/javascript" src="js/scriptPer.js" defer></script>
</head>

<body>
  <main>
    <div class="bg_img">
      <header>
        <div class="logo">
          <a href="../index.php">
            <img src="../img/Site-logo.png" alt="logo" />
          </a>
        </div>
        <!-- Mostrar usuario de sesión -->
        <div class="session-user">
          <?php
          if (isset($_SESSION['username'])) {
            echo '<p style="text-align:center;">¡Bienvenido, ' . $_SESSION['username'] . '!</p>';
          } else {
            echo '<p style="text-align:center;">No tienes iniciado la sesion</p>';
          }
          ?>
          <p style="text-align:center;">Idioma:</p>
          <div class="select-wrapper">
            <select id="language-selector">
              <option value="en">English</option>
              <option value="fr">French</option>
            </select>
          </div>
        </div>
      </header>

      <!-- Aquí está el contenedor del buscador -->
      <div id="buscador">
        <!-- Campo de entrada de texto para la búsqueda -->
        <input type="text" id="input-busqueda" placeholder="Buscar personaje..." oninput="buscarPersonaje()" />
        <!-- Botón de búsqueda -->
      </div>

      <div class="content-wrapper">
        <div class="container">
          <!-- Aquí se mostrarán los resultados de la búsqueda -->
          <div id="resultados-busqueda">
            <!-- Los resultados de la búsqueda se mostrarán aquí -->
          </div>
        </div>
        <br />
      </div>

    </div>


    <!-- Contenedor de comentarios -->
    <section id="comment-section">
      <h2 class="chat-title">Comenta los personajes con la comunidad</h2> <br>
      <form id="comment-form" method="post">
        <textarea name="text" id="comment-text" placeholder="Escribe tu comentario..." required></textarea>
        <input type="hidden" name="categoria" value="personajes">
        <button type="submit">Comentar</button>
      </form>
      <?php mostrarComentarios($conn, 'personajes'); ?>
    </section>
    </div>
  </main>
</body>

</html>