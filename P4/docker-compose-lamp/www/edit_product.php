<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $menu=array("Inicio"=>"index.php");

    $back="index.php";  //Fallback

    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $back=$_GET["back"];

    $id=-1;     //Error por defecto

    if(isset($_GET["id"]) and !empty($_GET["id"]))
        $id=$_GET["id"];

    
    session_start();
    $con=new GestorBD();

    $error=array();

    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
        //$error[]="";
        $esGestor=true;
    }
    else{
        $error[]="El usuario no es un gestor";
        $esGestor=false;        
    }

    //Parte de rellenar los campos
    if($con->existeProducto($id)){
        $producto=$con->getProducto($id);
        $fabricantes=$con->getAllFabricantes();
    }
    else{
        $error[]="El producto no existe";
    }

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('edit_product.twig', [
        "NombreForm" => "Cambiar datos de producto",
        "Menu" => $menu,
        "Back" => $back,
        "ProductID" => $id,
        "Errores" => $error,
        "EsGestor" => $esGestor,
        "Producto" => $producto,
        "Fabricantes" => $fabricantes
    ]);    
?>