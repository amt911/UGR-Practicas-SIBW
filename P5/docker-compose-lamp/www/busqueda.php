<?php
    include("bd.php");

    $con=new GestorBD();

    $res=$con->searchProductosAJAX($_GET["busqueda"]);

        echo(json_encode($res));
    //echo(json_encode($_GET));
?>