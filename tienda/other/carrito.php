<?php
require_once 'db.php';
require 'session.php';

if (!comprobar_sesion()) {
    // Verifica si el carrito está vacío
    if (empty($_SESSION['carrito'])) {
        ?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <link rel="stylesheet" href="style.css">

        </head>

        <body>
            <header>
                <?php require 'cabecera.php'; ?>
            </header>
            <main>
                <form action="../../login/login.html" method="post">
                    <div class="no-products">
                        <h2>No hemos encontrado ningun producto</h2>
                        <p>Parece que aún no tienes ningún producto. ¿Por qué no añades algunos?</p>
                        <button class="add-product-btn">Iniciar Session</button>
                    </div>
                </form>
            </main>
        </body>

        </html>

        <?php

        return;
    }
    return;
}
if (empty($_SESSION['carrito'])) {
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="carrito.css">
    </head>

    <body>
        <header>
            <?php require 'cabecera.php'; ?>
        </header>
        <main>
            <form action="tienda.php" method="post">
                <div class="no-products">
                    <h2>No hemos encontrado ningun producto</h2>
                    <p>Parece que aún no tienes ningún producto. ¿Por qué no añades algunos?</p>
                    <button class="add-product-btn">Añadir Producto</button>
                </div>
            </form>
        </main>
    </body>

    </html>

    <?php

    return;
}
$productos = cargar_productos(array_keys($_SESSION['carrito']));

// Verificar si la carga de productos fue exitosa
if ($productos === false) {
    echo "Error al cargar los productos.";
    return;
}

// hay que añadir las unidades al carrito
$productos = iterator_to_array($productos);
foreach ($productos as &$producto) {
    $cod = $producto['codProd'];
    $producto['unidades'] = $_SESSION['carrito'][$cod];
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style2.css">
<link rel="stylesheet" href="carrito.css">
<head>
</head>
<header>
    <?php require 'cabecera.php' ?>
</header>

<body>
    <ul>
        <?php foreach ($productos as &$producto): ?>
            <li>
                <div class="product-container">

                    <div class="product-details">
                        <div class="product-title"><?php echo $producto['nombre']; ?></div>
                        <div class="product-description"><?php echo $producto['descripcion']; ?></div>
                        <div class="product-price"><?php echo $producto['precio']; ?> €</div>
                        <div class="units">Unidades: <?php echo $producto['unidades']; ?></div>
                        <div class="button-group">
                            <form action="sumar.php" method="post">
                                <input type="hidden" name="codProd" value="<?php echo $producto['codProd']; ?>">
                                <input type="text" name="unidades" value="1">
                                <button type="submit" class="button">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </form>
                            <form action="eliminar.php" method="post">
                                <input type="hidden" name="codProd" value="<?php echo $producto['codProd']; ?>">
                                <input type="text" name="unidades" value="1">
                                <button type="submit" class="button">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                    <div class="product-image">
                        <img class="imgcarr" src="../../img/<?php echo $producto['imagen']; ?>"
                            alt="Imagen de <?php echo $producto['nombre']; ?>" class="categoria-imagen">
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="btn-carrito">
    <form action="eliminarCarrito.php" method="post">
        <input type="hidden" name="codProd" value="<?php echo $producto['codProd']; ?>">
        <button type="submit" class="button">
            <i class="fa-solid fa-trash"> Eliminar todo del carro</i>
        </button>
    </form>
    <form action="procesarPedido.php" method="post" class="confirm-button">
        <input type="hidden" name="confirmado" value="true">
        <button type="submit" class="button">
            <i class="fa-solid"> > Confirmar Pedido </i>
        </button>
    </form>
    </div>
</body>

</html>