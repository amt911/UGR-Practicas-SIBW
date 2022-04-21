<?php
    include("modelo.php");

    $con=new Modelo();

    echo json_encode($con->getPalabrotas());
?>