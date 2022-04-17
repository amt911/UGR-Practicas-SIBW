<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $mysqli=conectarDB();

    $numFilas=getNumFilasProducto($mysqli);
    $id=1;

    if(isset($_GET["p"]) and $_GET["p"]<=$numFilas)
        $id=$_GET["p"];

    $fabricaRes=getFabrica($id, $mysqli);
    $res=getProducto($id, $mysqli);
    $fabricanteRes=getFabricante($fabricaRes["Nombre"], $mysqli);
    $comentarios=getAllComments($mysqli, $id);
    //Hace falta meter un getFabrica para obtener la tabla intermedia

    if(isset($_GET["imprimir"]) and $_GET["imprimir"]==1)
        $pagina="producto_imprimir.twig";
    else
    $pagina="producto.twig";
    
    echo $twig->render($pagina, [
        "Titulo" => $res["Titulo pagina"],
        "Opcion1" => "Inicio",
        "Opcion2" => "Imprimir",
        "Opcion3" => "Login",
        "NombreProducto" => $res["Nombre"],
        "Fabricante" => $fabricanteRes["Nombre"],
        "Precio" => $res["Precio"],
        "Descripcion" => $res["Descripción"],
        "Images" => $res["Imagenes"],
        //"imgComentarios" => array_combine($res["Imagenes"], $res["Comentarios"],
        "PaginaOficial" => $fabricanteRes["Pagina oficial"],
        "Video" => $res["Video"],
        "Twitter" => $fabricanteRes["Twitter"],
        "YouTube" => $fabricanteRes["YouTube"],
        "Facebook" => $fabricanteRes["Facebook"],
        "Tabla" => $res["Tabla"],
        "ID" => $id,
        "Imprimir" => $_GET["imprimir"],
        "Comentarios" => $comentarios,
    ]);
?>