<?php
include("bd.php");

session_start();

$con=new GestorBD("root", "tiger");
//$con=new GestorBD();


$back=1;      //Fallback

if(isset($_GET["back"])){
    $back=$_GET["back"];
}

$correo="-1";

if(isset($_SESSION["correo"])){
    $correo=$_SESSION["correo"];
}

$usuario=$con->getUsuario($correo);

if($usuario["Correo"]!=null and $usuario["esModerador"]==1 and isset($_GET["id"])){
    $con->deleteComment($_GET["id"], $correo);
}


header("Location: producto.php?p=$back");
exit();

/*
if($usuario["Correo"]==null)
echo "Hola usuario no registrado";
else if($usuario["esModerador"]==1)
echo "Hola usuario registrado";
else
echo "NO TIENES PERMISO";
*/
?>