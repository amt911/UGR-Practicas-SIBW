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
            //var_dump($con->existeProductoNombre($nombre));
            if(!$con->existeProductoNombre($nombre)){
            $id=$con->insertProducto($_SESSION["usuario"]["ID"], $nombre, $precio, $descripcion, $tituloTab, $fabricante, $_FILES["imagenes"]);

            if(!empty($_POST["etiquetas"]) and isset($_POST["etiquetas"])){
                $etiquetas=$_POST["etiquetas"];
                //eliminar espacios
                $etiquetas=str_replace(" ", "", $etiquetas);

                //separar por comas y obtener un array
                $etiquetas=explode(",", $etiquetas);

                //var_dump($etiquetas);
                $con->insertEtiquetas($_SESSION["usuario"]["ID"], $id, $etiquetas);
            }

            if(empty($_FILES["imagenes"]["name"][0]) and count($_FILES["imagenes"]["name"])==1){
                header("Location: $back");
                exit();
            }
//  var_dump($id);
            header("Location: comentarios_imagen_form.php?back=$back&id=$id");
            exit();            
            }
            $errores[]="Ya existe el producto";

        }
        else
            $errores[]="El precio debe ser un número";
    }
    else{
        $errores[]="No se han rellenado todos los campos";
    }
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