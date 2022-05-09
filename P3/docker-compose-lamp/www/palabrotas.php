<?php
    include("bd.php");

    $con=new GestorBD();

    echo json_encode($con->getPalabrotas());
?>