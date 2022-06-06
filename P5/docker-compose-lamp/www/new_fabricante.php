<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    session_start();

    $con=new GestorBD();

    $menu=array("Inicio"=>"index.php");

    $back="index.php";  //Fallback
    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $back=$_GET["back"];

    $errores=array();

    //Parte de mostrar el formulario o no, dependiendo de si tiene permisos
    $showForm=false;
    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){    
        $showForm=true;
    }
    else
        $errores[]="El usuario no es un gestor o no está registrado";
        
    //Parte de enviar el formulario, en caso de no estar regitrado o no tener permisos, no se envía
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
        $back=$_POST["back"];
        $nombre=$_POST["nombre"];
        $facebook=$_POST["facebook"];
        $twitter=$_POST["twitter"];
        $youtube=$_POST["youtube"];
        $oficial=$_POST["oficial"];

        if(!empty($nombre)){
            if(!$con->existeFabricante($nombre)){
                $con->addFabricante($_SESSION["usuario"]["ID"], $nombre, $facebook, $twitter, $youtube, $oficial);

                header("Location: $back");
                exit();
            }
            $errores[]="El fabricante ya existe";
        }
        else
            $errores[]="El nombre no puede estar vacío";
    }

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('new_fabricante.twig', [
        "NombreForm" => "Nuevo fabricante",
        "Titulo" => "Nuevo fabricante",
        "Menu" => $menu,
        "Back" => $back,
        "Errores" => $errores,
        "ShowForm" => $showForm,
        "Titulo" => "Nuevo fabricante",
    ]);
?>