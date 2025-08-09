<?php
require_once 'db.php';
// session_start();
// require_once 'session.php';
// if (!comprobar_sesion())
//     return;
$categorias = cargar_categorias();
// $cat_json = json_encode(
//     iterator_to_array($categorias),
//     true
// );
// function debug_to_console($data) {
//     $output = $data;
//     if (is_array($output))
//         $output = implode(',', $output);

//     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
// }
// echo $cat_json;
// debug_to_console($cat_json) ;

?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <main id="main-container-categoria">
        <?php foreach ($categorias as $categoria): ?>
            <div class="container">
                <div class="category">
                    <a href="productos.php?id=<?php echo $categoria['codCat']; ?>">
                        <img src="../../img/<?php echo $categoria['ruta_imagen']; ?>"
                            alt="Imagen de <?php echo $categoria['nombre']; ?>" class="categoria-imagen">
                    </a>
                    <div class="category-info">
                        <a href="productos.php?id=<?php echo $categoria['codCat']; ?>">
                            <h3><?php echo $categoria['nombre']; ?></h3>
                            <p><?php echo $categoria['descripcion']; ?></p>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
</body>

</html>