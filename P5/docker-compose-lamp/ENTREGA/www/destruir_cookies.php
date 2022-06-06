<?php
    session_start();
    session_destroy();

    $_SESSION=array();

    $url="index.php";

    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $url=$_GET["back"];

    header("Location: $url");
?>