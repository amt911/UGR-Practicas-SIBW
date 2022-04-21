<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $con=new Modelo();

    $res=$con->getAllProducts();

    echo $twig->render('portada.twig', [
        "Titulo" => "e-tienda. Más que comercio",
        "Opcion1" => "Inicio",
        "Opcion2" => "FAQ",
        "Opcion3" => "Login",
        "Productos" => $res
    ]);
?>