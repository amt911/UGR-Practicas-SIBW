<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    session_start();
    $con=new GestorBD("root", "tiger");

    $errores=array();
    $menu=array("Inicio"=>"index.php");

    $back="index.php";  //Fallback
    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $back=$_GET["back"];


    //Parte de mostrar el formulario o no, dependiendo de si tiene permisos
    $showForm=false;
    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){    
        $showForm=true;
    }
    else
        $errores[]="El usuario no es un gestor o no está registrado";

    $fabricantes=$con->getAllFabricantes();

    
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
        $back=$_POST["back"];

        foreach($_POST as $key => $valor){
            if($key!="back" and $valor=="on"){
                $con->deleteFabricante($_SESSION["usuario"]["ID"], $key);
            }
        }

        header("Location: $back");
        exit();
    }

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('delete_fabricante.twig', [
        "NombreForm" => "Eliminar fabricantes",
        "Menu" => $menu,
        "Back" => $back,
        "Errores" => $errores,
        "ShowForm" => $showForm,
        "Fabricantes" => $fabricantes,
        "Titulo" => "Eliminar fabricantes",
    ]);    
?>