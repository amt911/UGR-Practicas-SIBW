<?php
include("bd.php");

session_start();

$con=new GestorBD("root", "tiger");

$back="index.php";      //Fallback
if(isset($_GET["back"]) and !empty($_GET["back"])){
    $back=$_GET["back"];
}

if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["ID"]!=-1 and $_SESSION["usuario"]["esModerador"]==1 and isset($_GET["id"]) and !empty($_GET["id"]) and is_numeric($_GET["id"])){
    $con->deleteComment($_GET["id"], $_SESSION["usuario"]["ID"]);
}

//header("Location: producto.php?p=$back");
header("Location: $back");
exit();
?>