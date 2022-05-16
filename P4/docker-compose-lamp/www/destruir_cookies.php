<?php
    session_start();
    session_destroy();

    $url="index.php";

    if(isset($_GET["back"]))
        $url=$_GET["back"];

    header("Location: $url");
?>