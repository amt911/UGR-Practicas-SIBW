<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $con=new Modelo();

    $menu=array("Inicio"=>"index.php",
                "FAQ" => "index.php",
                "Login" => "index.php");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    echo $twig->render('portada.twig', [
        "Titulo" => "e-tienda. Más que comercio",
        "Menu" => $menu,
        "Productos" => $con->getAllProducts()
    ]);
?>