<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    //$mysqli=conectarDB();
    $con=new Modelo();

    $numFilas=$con->getNumFilasProducto();
    $id=1;

    if(isset($_GET["p"]) and $_GET["p"]<=$numFilas)
        $id=$_GET["p"];

    $fabricaRes=$con->getFabrica($id);
    $res=$con->getProducto($id);
    $fabricanteRes=$con->getFabricante($fabricaRes["Nombre"]);
    $comentarios=$con->getAllComments($id);
    //Hace falta meter un getFabrica para obtener la tabla intermedia

    if(isset($_GET["imprimir"]) and $_GET["imprimir"]==1)
        $pagina="producto_imprimir.twig";
    else
    $pagina="producto.twig";
    

    $palabrotas=$con->getPalabrotas();

    //echo json_encode($palabrotas);

    //echo $res["Comentarios"];

    function get_imagenes_comentarios($i, $c){
        $res=false;
        $array_i=preg_split("/\R/", $i);
        $array_c=preg_split("/\R/", $c);

        if(count($array_c)==count($array_i)){
            $res=array_combine($array_i, $array_c);
        }

        return $res;
    }

    echo $twig->render($pagina, [
        "Imprimir" => $_GET["imprimir"],
        "Titulo" => $res["Titulo pagina"],
        "Opcion1" => "Inicio",
        "Opcion2" => "Imprimir",
        "Opcion3" => "Login",
        "NombreProducto" => $res["Nombre"],
        "Fabricante" => $fabricanteRes["Nombre"],
        "Precio" => $res["Precio"],
        "Descripcion" => $res["Descripción"],
        "Images" => get_imagenes_comentarios($res["Imagenes"], $res["Comentarios"]),
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