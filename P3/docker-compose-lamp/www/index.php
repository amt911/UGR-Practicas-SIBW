<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $con=new Modelo();

    $menu=array("Inicio"=>"index.php",
                "FAQ" => "index.php",
                "Login" => "index.php");


    $productos=$con->getAllProducts();
    
    //Inserto en el array asociativo de productos la ruta de las imagenes que se encuentran en otra tabla
    //Esto lo hago por comodidad a la hora de usar TWIG
    for($i=0; $i<count($productos); $i++){
        $imagen=$con->get_imagenes($productos[$i]["ID"])[0]["Ruta Imagen"];
        if($imagen==false)
            $imagen="placeholder.png";
            
        $productos[$i]["Imagenes"]=$imagen;
    }

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    echo $twig->render('portada.twig', [
        "Titulo" => "e-tienda. Más que comercio",
        "Menu" => $menu,
        "Productos" => $productos
    ]);
?>