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
        $showForm=true;
    }
    else{
        $error[]="El usuario no es un gestor";
        $showForm=false;        
    }

    //Parte de rellenar los campos IMPORTANTE JUNTARLO TODO
    if(!$con->existeProducto($id)){
        $error[]="El producto no existe";
    }

    //Parte de POST
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
        if(!empty($_POST["etiquetas"]) and isset($_POST["etiquetas"])){
            $id=$_POST["id"];
            $back=$_POST["back"];
            $etiquetas=$_POST["etiquetas"];
            
            //eliminar espacios
            $etiquetas=str_replace(" ", "", $etiquetas);

            //separar por comas y obtener un array
            $etiquetas=explode(",", $etiquetas);
            $con->insertEtiquetas($_SESSION["usuario"]["ID"], $id, $etiquetas);

    
            header("Location: $back");
            exit();
        }            
        $error[]="El campo no puede estar vacío";
    }

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('new_etiquetas.twig', [
        "NombreForm" => "Añadir etiquetas nuevas al producto",
        "Menu" => $menu,
        "Back" => $back,
        "ProductID" => $id,
        "Errores" => $error,
        "ShowForm" => $showForm,
    ]);    
?>