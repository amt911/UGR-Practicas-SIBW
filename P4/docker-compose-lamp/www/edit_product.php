<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $menu=array("Inicio"=>"index.php");

    $back="index.php";  //Fallback

    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $back=$_GET["back"];

    $id=-1;     //Error por defecto

    if(isset($_GET["id"]) and !empty($_GET["id"]) and is_numeric($_GET["id"]))
        $id=$_GET["id"];

    
    session_start();
    $con=new GestorBD();

    $error=array();

    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
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


    //Parte de POST
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION["usuario"])){
        if(empty($_POST["precio"]) or empty($_POST["nombre"]) or empty($_POST["descripcion"]) or empty($_POST["titulo-top"]) or !is_numeric($_POST["precio"])){
            $error[]="Hay campos obligatorios vacíos o incorrectos";

            $back=$_POST["back"];
        }
        else{
            $con->cambiarDatosProducto($_SESSION["usuario"]["ID"], $_POST["product-id"], $_POST["precio"], $_POST["nombre"], $_POST["descripcion"], $_POST["titulo-top"], $_POST["fabricante"]);

            $back=$_POST["back"];
            header("Location: $back");
            exit();
        }
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