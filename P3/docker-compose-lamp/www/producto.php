<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $mysqli=conectarDB();

    $varBORRAR=1;

    $fabricaRes=getFabrica($varBORRAR, $mysqli);

    $res=getProducto($varBORRAR, $mysqli);
    $fabricanteRes=getFabricante($fabricaRes["Nombre"], $mysqli);

    $productos=getAllProducts($mysqli);
    //Hace falta meter un getFabrica para obtener la tabla intermedia


    echo $twig->render('producto.twig', [
        "Titulo" => $res["Titulo pagina"],
        "Opcion1" => "Inicio",
        "Opcion2" => "Imprimir",
        "Opcion3" => "Login",
        "NombreProducto" => $res["Nombre"],
        "Fabricante" => $fabricanteRes["Nombre"],
        "Precio" => $res["Precio"],
        "Descripcion" => $res["Descripción"],
        "img1" => $res["img1"],
        "img2" => $res["img2"],
        "img1Comentario" => $res["img1 Comentario"],
        "img2Comentario" => $res["img2 Comentario"],
        "PaginaOficial" => $fabricanteRes["Pagina oficial"],
        "Video" => $res["Video"],
        "Twitter" => $fabricanteRes["Twitter"],
        "YouTube" => $fabricanteRes["YouTube"],
        "Facebook" => $fabricanteRes["Facebook"],
        "Tabla" => $res["Tabla"],
        "Productos" => $productos
    ]);
?>