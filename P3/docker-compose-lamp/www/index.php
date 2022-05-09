<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $con=new GestorBD();

    //Botones de navegacion
    $menu=array("Inicio"=>"index.php",
                "FAQ" => "index.php",
                "Login" => "index.php");

    //El numero total de paginas que tiene la portada
    $totalPaginas=$con->getNumPaginas();

    $pagina=1;

    if(isset($_GET["pagina"]) and $_GET["pagina"]>0 and $_GET["pagina"]<=$totalPaginas){
        $pagina=$_GET["pagina"];
    }

    //Ya sabiendo la pagina, se obtienen los productos
    $productos=$con->getProductsPage($pagina);

    //Inserto en el array asociativo de productos la ruta de las imagenes que se encuentran en otra tabla
    //Esto lo hago por comodidad a la hora de usar TWIG
    for($i=0; $i<count($productos); $i++){
        $imagen=$con->getImagenes($productos[$i]["ID"])[0]["Ruta Imagen"];
        if($imagen==false)
            $imagen="placeholder.png";
            
        $productos[$i]["Imagenes"]=$imagen;
    }


    //Las flechas de navegacion entre paginas
    $anterior=$pagina-1;
    $siguiente=$pagina+1;

    if($anterior<=0) 
        $anterior=$pagina;

    if($siguiente>$totalPaginas)
        $siguiente=$pagina;

    //Supongo que el minimo es 1 y el maximo 5
    $maxPagina=5;
    $minPagina=1;

    //Si la pagina en la que se encuentra es mayor, o se encuentra a uno menos del 5, se entra
    if($pagina>=$maxPagina or ($pagina+1)==$maxPagina){
        //Se calcula la diferencia para llegar a pagina y se le añade a ambos
        $aux=$pagina-$maxPagina;

        $minPagina+=(2+$aux);
        $maxPagina+=(2+$aux);
    }

    //Si la pagina ha sobrepasado al maximo permitido
    if($maxPagina>$totalPaginas)
        $maxPagina=$totalPaginas;

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('portada.twig', [
        "Titulo" => "e-tienda. Más que comercio",
        "Menu" => $menu,
        "Productos" => $productos,
        "MinPagina" => $minPagina,
        "MaxPagina" => $maxPagina,
        "Anterior" => $anterior,
        "Siguiente" => $siguiente,
        "Actual" => $pagina
    ]);
?>