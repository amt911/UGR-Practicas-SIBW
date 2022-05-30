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
    if(isset($_GET["id"]) and !empty($_GET["id"]) and $con->existeProducto($_GET["id"])){
        $id=$_GET["id"];
        $showForm=true;
    }
    else
        $errores[]="No se ha especificado el producto";
}
else
    $errores[]="El usuario no es un gestor o no está registrado";


$imagenes=$con->getImagenes($id);

//Obtener todos los fabricantes
//$fabricantes=$con->getAllFabricantes();

if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
    $back=$_POST["back"];
    $imagenes=$con->getImagenes($_POST["idProducto"]);

    //var_dump($_POST["imagen".$i]);
    //var_dump($_POST["imagen_".$i]);

    for($i=0; $i<count($imagenes); $i++){
        $con->insertarComentarioImagen($_SESSION["usuario"]["ID"], $imagenes[$i]["ID_Producto"], $imagenes[$i]["Ruta Imagen"], $_POST["imagen_".$imagenes[$i]["Ruta Imagen"]]);
    }

    header("Location: $back");
    exit();
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render("comentarios_imagen_form.twig", [
    "NombreForm" => "Añadir producto",
    "Menu" => $menu,
    "Errores" => $errores,
    "ShowForm" => $showForm,
    "Back" => $back,
    "Fabricantes" => $fabricantes,
    "Imagenes" => $imagenes,
    "idProducto" => $id
]);
?>