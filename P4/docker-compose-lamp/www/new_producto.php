<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

session_start();

$con=new GestorBD();

$menu=array("Inicio"=>"index.php");
$errores=array();

//Parte de mostrar el formulario o no, dependiendo de si tiene permisos
$showForm=false;
if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){    
    $showForm=true;
}
else
    $errores[]="El usuario no es un gestor o no está registrado";


//Obtener todos los fabricantes
$fabricantes=$con->getAllFabricantes();

if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
    $back=$_POST["back"];
    $nombre=$_POST["nombre"];
    $precio=$_POST["precio"];
    $descripcion=$_POST["descripcion"];
    $tituloTab=$_POST["titulo-tab"];
    $fabricante=$_POST["fabricante"];

    if(!empty($descripcion) and !empty($nombre) and !empty($fabricante) and !empty($tituloTab) and !empty($precio)){
        if(is_numeric($precio)){
            $con->insertProducto($_SESSION["usuario"]["ID"], $nombre, $precio, $descripcion, $tituloTab, $fabricante);
            

            header("Location: $back");
            exit();
        }
        $errores[]="El precio debe ser un número";
    }
    else{
        $errores[]="No se han rellenado todos los campos";
    }


    //header("Location: $back");
    //exit();
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render("new_producto.twig", [
    "NombreForm" => "Añadir producto",
    "Menu" => $menu,
    "Errores" => $errores,
    "ShowForm" => $showForm,
    "Back" => $back,
    "Fabricantes" => $fabricantes
]);
?>