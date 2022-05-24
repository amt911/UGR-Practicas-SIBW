<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

session_start();

$con=new GestorBD();

$menu=array("Inicio"=>"index.php");

if(isset($_SESSION["usuario"])){
    $error=0;
}
else
    $error=-1;

//var_dump($_SESSION["usuario"]);

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render("perfil.twig", [
    "NombreForm" => "Mi perfil",
    "Menu" => $menu,
    "Credenciales" => $_SESSION["usuario"],
    "Errores" => $error
]);
?>