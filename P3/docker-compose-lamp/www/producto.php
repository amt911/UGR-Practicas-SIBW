<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $mysqli=conectarDB();

    $res=getProducto(1, $mysqli);

    echo $twig->render('producto.twig', [
        "Titulo" => $res["Titulo pagina"],
        "Opcion1" => "Inicio",
        "Opcion2" => "Imprimir",
        "Opcion3" => "Login",
        "NombreProducto" => $res["Nombre"],
        "Fabricante" => $res["Fabricante"],
        "Precio" => $res["Precio"],
        "Ddescripcion" => $res["Descripción"],
        "img1" => $res["img1"],
        "img2" => $res["img2"],
        "img1Comentario" => $res["img1 Comentario"],
        "img2Comentario" => $res["img2 Comentario"],
    ]);
?>