<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css"> 

</head>
<body>
    <header>
        <div class="header-container">
            <span id="cab_usuario">
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo "<p><i class='fa-solid'><i class='fa-solid fa-user'></i>&nbsp " . $_SESSION['username'] . "&nbsp<a class='saldo' href='saldo.php'>&nbsp <i class='fa-solid fa-money-bill'></i> &nbsp" . mostrarSaldo($_SESSION['username']) . " €.</a></i></p>";
                }
                ?>
            </span>
            <nav>
                <ul>
                    <li><i class="fa-solid"><a href="tienda.php"><i class="fa-solid fa-house"></i> &nbsp; Home</a></i></li>
                    <li><i class="fa-solid"><a href="carrito.php"> Carrito</a></i></li>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<li><i class="fa-solid"><a href="logout.php">Cerrar sesion</a></i></li>';
                    } else {
                        echo '<li><i class="fa-solid"><a href="../../login/login.html">Iniciar sesion</a></i></li>';
                    }
                    ?>
                    <li><a href="../../index.php"><i class="fa-solid fa-book-open">&nbsp; WIKI</a></i></li>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>

<?php
  $hostname = "fdb1032.awardspace.net";
  $username = "4482497_tiendawiki";
  $password = "Proyecto.2024";
  $dbname = "4482497_tiendawiki";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
  ?>