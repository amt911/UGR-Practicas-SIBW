<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    session_start();

    $con=new GestorBD();
    $errores=array();

    $back="index.php";

    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $back=$_GET["back"]; 

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $correo=$_POST["correo"];
        $contra=$_POST["contra"];
        $back=$_POST["anterior"];

        if($con->comprobarCredenciales($correo, $contra)){
            $_SESSION["usuario"]=$con->getUsuario2($correo ,"Correo");

            header("Location: $back");
            exit();
        }
        $errores[]="Usuario/Contraseña incorrectos";
    }

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('login.twig', [
    "Errores" => $errores,
    "Back" => $back,
    "Titulo" => "Iniciar sesión",
    "Header" => "Iniciar sesión",
]);
?>