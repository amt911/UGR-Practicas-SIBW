<?php
    include("bd.php");

    $con=new GestorBD();

    $status=false;
    if(isset($_POST["id"]) and isset($_POST["set"]) and ($_POST["set"]==0 or $_POST["set"]==1)){
        $id=$_POST["id"];
        $set=$_POST["set"];

        $con->cambiarEstadoPublicacion($id, $set);

        $status=true;
    }

    echo json_encode(array("status"=>$status));
?>