<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $con=new Modelo();

    $menu=array("Inicio"=>"index.php",
                "FAQ" => "index.php",
                "Login" => "index.php");

    $totalPaginas=$con->getNumPaginas();
    //$totalPaginas=5;
    $pagina=1;

    if(isset($_GET["pagina"]) and $_GET["pagina"]>0 and $_GET["pagina"]<=$totalPaginas){
        $pagina=$_GET["pagina"];
    }

    $productos=$con->getProductsPage($pagina);

    //Inserto en el array asociativo de productos la ruta de las imagenes que se encuentran en otra tabla
    //Esto lo hago por comodidad a la hora de usar TWIG
    for($i=0; $i<count($productos); $i++){
        $imagen=$con->get_imagenes($productos[$i]["ID"])[0]["Ruta Imagen"];
        if($imagen==false)
            $imagen="placeholder.png";
            
        $productos[$i]["Imagenes"]=$imagen;
    }

    $anterior=$pagina-1;
    $siguiente=$pagina+1;

    if($anterior<=0) 
        $anterior=$pagina;

    if($siguiente>$totalPaginas)
        $siguiente=$pagina;

    //Supongo que el minimo es 1 y el maximo 5
    $max_pagina=5;
    $min_pagina=1;

    //Si la pagina en la que se encuentra es mayor, o se encuentra a uno menos del 5, se entra
    if($pagina>=$max_pagina or ($pagina+1)==$max_pagina){
        //Se calcula la diferencia para llegar a pagina y se le añade a ambos
        $aux=$pagina-$max_pagina;

        $min_pagina+=(2+$aux);
        $max_pagina+=(2+$aux);
    }

    //Si la pagina ha sobrepasado al maximo permitido
    if($max_pagina>$totalPaginas)
        $max_pagina=$totalPaginas;

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('portada.twig', [
        "Titulo" => "e-tienda. Más que comercio",
        "Menu" => $menu,
        "Productos" => $productos,
        "MinPagina" => $min_pagina,//$min_pagina,
        "MaxPagina" => $max_pagina,//$max_pagina, //300,
        "Anterior" => $anterior,
        "Siguiente" => $siguiente,
        "Actual" => $pagina
    ]);
?>