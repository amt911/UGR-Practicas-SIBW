<?php
include("bd.php");

session_start();

$con=new GestorBD(true);

$back="index.php";      //Fallback
if(isset($_GET["back"]) and !empty($_GET["back"])){
    $back=$_GET["back"];
}

if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["ID"]!=-1 and $_SESSION["usuario"]["esModerador"]==1 and isset($_GET["id"]) and !empty($_GET["id"]) and is_numeric($_GET["id"])){
    $con->deleteComment($_GET["id"]);
}

//header("Location: producto.php?p=$back");
header("Location: $back");
exit();
?>