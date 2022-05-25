<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

session_start();

$con=new GestorBD();

$menu=array("Inicio"=>"index.php");

//Parte de GET
/*
if(isset($_SESSION["usuario"])){
    $error="No se encuentra identificado";
}
else
    $error="";
*/
$error[]="No se encuentra identificado";
$estaRegistrado=false;
//Parte de POST
/*
if($_SERVER["REQUEST_METHOD"]=="POST"){
    header("Location: destruir_cookies.php");
    exit();
}
*/

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render("edit_perfil.twig", [
    "NombreForm" => "Cambiar datos de perfil",
    "Menu" => $menu,
    "Credenciales" => $_SESSION["usuario"],
    "Errores" => $error,
    "User" => $_SESSION["usuario"],
    "Tipo" => 7,
    "estaRegistrado" => $estaRegistrado
]);
?>