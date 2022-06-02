<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

session_start();

$con=new GestorBD();

$menu=array("Inicio"=>"index.php");
$errores=array();

if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"])){
    $error=0;
}
else{
    $error=-1;
    $errores[]="El usuario no está registrado";
}


$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render("perfil.twig", [
    "NombreForm" => "Mi perfil",
    "Menu" => $menu,
    "Credenciales" => $_SESSION["usuario"],
    "Pais" => $con->getPais($_SESSION["usuario"]["CountryCode"]),
    "Error" => $error,
    "Titulo" => "Mi perfil",
    "Errores" => $errores
]);
?>