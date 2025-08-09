<?php
require_once 'db.php';
require 'session.php';
// session_start();
/*comprueba que el usuario haya abierto sesión o
devuelve*/
// if (!comprobar_sesion())
//     return;

// $cat_json = json_encode(
//     iterator_to_array($productos),
//     true
// );
// echo $cat_json;


$productos_array = [];
$productos = cargar_productos_categoria(
    $_GET['id']
);


?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">

<head>
</head>
<header>
    <?php require 'cabecera.php' ?>
</header>

<body>
    <section class="product-grid">
        <?php
        if (!empty($productos)) {

            foreach ($productos as $producto) {
                ?>
                <div class="product-card">
                    <div class="product-image">
                        <img class="img-product" src="../../img/<?php echo $producto['imagen']; ?>"
                            alt="Imagen de <?php echo $producto['nombre']; ?>" class="categoria-imagen">
                    </div>
                    <div class="product-details">
                        <h3 class="product-title"><?php echo $producto['nombre']; ?></h3>
                        <p class="product-description"><?php echo $producto['descripcion']; ?></p>
                        <p class="product-price"><?php echo $producto['precio']; ?> €</p>
                        <!-- <span class="product-stock">In Stock</span> -->
                        <div class="product-buy">
                            <?php echo anadirProd("Comprar", $producto['codProd'], $_GET['id']); ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No se encontraron productos en esta categoría.";
        }
        ?>
    </section>
</body>

</html>

<?php

function anadirProd($texto, $cod, $codCat)
{
    return "
    <form action='anadir.php' method='post'>
        <input type='hidden' name='codProd' value='$cod'>
        <input type='hidden' name='codCat' value='{$_GET['id']}'>
        <input type='text' name='unidades' value='1'>
        <input type='submit' value='$texto'>
    </form>";
}

?>