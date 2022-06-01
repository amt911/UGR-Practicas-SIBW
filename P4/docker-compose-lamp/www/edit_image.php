<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

session_start();

$con=new GestorBD();

$back="index.php";

if(isset($_GET["back"]) and !empty($_GET["back"])){
    $back=$_GET["back"];
}


$menu=array("Inicio"=>"index.php");
$errores=array();

//Parte de mostrar el formulario o no, dependiendo de si tiene permisos
$showForm=false;
if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){    
    if(isset($_GET["id"]) and !empty($_GET["id"]) and $con->existeImagen($_GET["id"])){
        $id=$_GET["id"];
        $showForm=true;
    }
    else
        $errores[]="No se ha especificado la imagen";
}
else
    $errores[]="El usuario no es un gestor o no está registrado";


$imagen=$con->getImagenIDImg($id);

if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
    $back=$_POST["back"];
    //$imagen=$con->getImagenes($_POST["idProducto"]);
    $imagen=$con->getImagenIDImg($_POST["id"]);
    //var_dump($imagen);
    $con->insertarComentarioImagen($_SESSION["usuario"]["ID"], $imagen["ID_Producto"], $imagen["Ruta Imagen"], $_POST[$imagen["ID_Imagen"]]);

    header("Location: $back");
    exit();
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render("edit_image.twig", [
    "NombreForm" => "Editar comentario imagen",
    "Menu" => $menu,
    "Errores" => $errores,
    "ShowForm" => $showForm,
    "Back" => $back,
    "Fabricantes" => $fabricantes,
    "Imagen" => $imagen,
    "idImagen" => $id
]);
?>