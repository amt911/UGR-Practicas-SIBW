<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);/*, [
    'cache' => '/directorioCache',
    ]);*/
    // Averiguo que la página que se quiere mostrar es la del producto 12,
    // porque hemos accedido desde http://localhost/?producto=12
    // Busco en la base de datos la información del producto y lo
    // almaceno en las variables $productoNombre, $productoMarca, $productoFoto...
    echo $twig->render('producto.twig', [
        "Titulo" => "NVIDIA RTX 3090",
        "Opcion1" => "Inicio",
        "Opcion2" => "Imprimir",
        "Opcion3" => "Login",
        "NombreProducto" => "NVIDIA GeForce RTX 3090 Founders Edition",
        "Fabricante" => "NVIDIA",
        "Precio" => "2200.-",
        "img1" => "3090.png",
        "img2" => "3090_2.png",
        "img1Comentario" => "Frontal",
        "img2Comentario" => "Vista General",
    ]);
?>