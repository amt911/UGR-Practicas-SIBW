<?php
    // Inicializamos el motor de plantillas
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    //Conecto con la base de datos y obtengo el numero de productos para obtener su id
    $con=new Modelo();
    $numFilas=$con->getNumFilasProducto();

    //Supongo que si el usuario introduce un identificador invalido se redirige al primero
    $id=1;

    if(isset($_GET["p"]) and $_GET["p"]<=$numFilas)
        $id=$_GET["p"];

    //Parte de hacer las queries
    $fabricaRes=$con->getFabrica($id);
    $res=$con->getProducto($id);
    $fabricanteRes=$con->getFabricante($fabricaRes["Nombre"]);
    $comentarios=$con->getAllComments($id);
    $palabrotas=$con->getPalabrotas();
    $imagenes=$con->get_imagenes($id);

    //Si no ha encontrado ninguna imagen se pone un placeholder
    //Esto es necesario para que funcione la pagina ya que
    //Utiliza eventos en esa parte de html
    if($imagenes==false){
        $imagenes=array(array("Ruta Imagen"=>"placeholder.png", "Descripcion"=>"placeholder"));
    }

    //Para lanzar la version imprimible o no
    if(isset($_GET["imprimir"]) and $_GET["imprimir"]==1){
        $pagina="producto_imprimir.twig";
        
        $imagenes=array_slice($imagenes, 0, 2);
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
        "Images" => $imagenes,//$con->get_imagenes_comentarios($id),
        "PaginaOficial" => $fabricanteRes["Pagina oficial"],
        //"Video" => $res["Video"],
        "Twitter" => $fabricanteRes["Twitter"],
        "YouTube" => $fabricanteRes["YouTube"],
        "Facebook" => $fabricanteRes["Facebook"],
        "Tabla" => $res["Tabla"],
        "ID" => $id,
        "Imprimir" => $_GET["imprimir"],
        "Comentarios" => $comentarios,
    ]);
?>