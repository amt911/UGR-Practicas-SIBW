<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    //Conexion base de datos
    $con=new GestorBD();

    //Identificador del producto junto su comprobacion
    $id=1;

    if(isset($_GET["p"]) and $con->existeProducto($_GET["p"]))
        $id=$_GET["p"];

    
    //Parte de hacer las queries
    $res=$con->getProducto($id);
    $fabricanteRes=$con->getFabricante($res["Nombre_Fabricante"]);
    $comentarios=$con->getAllComments($id);
    $palabrotas=$con->getPalabrotas();
    $imagenes=$con->getImagenes($id);

    //Si no ha encontrado ninguna imagen se pone un placeholder
    if($imagenes==false){
        $imagenes=array(array("Ruta Imagen"=>"placeholder.png", "Descripcion"=>"placeholder"));
    }

    //Para lanzar la version imprimible o no
    if(isset($_GET["imprimir"]) and $_GET["imprimir"]==1){
        $pagina="producto_imprimir.twig";
        
        $imagenes=array_slice($imagenes, 0, 2); //Solo se ponen las dos primeras imagenes
    }
    else
        $pagina="producto.twig";
    
    
    //Los botones del menu con sus respectivas paginas
    $menu=array("Inicio"=>"index.php",
                "Imprimir"=>"producto.php?p=$id&imprimir=1",
                "Login"=>"producto.php?p=$id");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    echo $twig->render($pagina, [
        "Imprimir" => $_GET["imprimir"],
        "Titulo" => $res["Titulo pagina"],
        "Menu" => $menu,
        "NombreProducto" => $res["Nombre"],
        "Fabricante" => $fabricanteRes["Nombre"],
        "Precio" => $res["Precio"],
        "Descripcion" => $res["Descripción"],
        "Images" => $imagenes,
        "PaginaOficial" => $fabricanteRes["Pagina oficial"],
        "Twitter" => $fabricanteRes["Twitter"],
        "YouTube" => $fabricanteRes["YouTube"],
        "Facebook" => $fabricanteRes["Facebook"],
        "Tabla" => $res["Tabla"],
        "ID" => $id,
        "Imprimir" => $_GET["imprimir"],
        "Comentarios" => $comentarios,
    ]);
?>