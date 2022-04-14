<?php
function conectarDB(){
    $mysqli=new mysqli("mysql", "root", "tiger", "docker");

    if($mysqli->connect_errno){
        echo("Fallo al conectar: ". $mysqli->connect_error);
        $mysqli=-1;
    }

    return $mysqli;
}
//Hace falta dejarlo mejor para evitar inyeccion
function getProducto($id, $mysqli){
    $res=$mysqli->query("SELECT * FROM Productos WHERE ID=$id");

    //if($res->num_rows > 0){
    $row=$res->fetch_assoc();
    //}

    return $row;
}


function getFabrica($id, $mysqli){
    $res=$mysqli->query("SELECT * FROM Fabrica WHERE ID='$id'");

    //if($res->num_rows > 0){
    $row=$res->fetch_assoc();
    //}

    return $row;    
}

function getFabricante($id, $mysqli){
    $res=$mysqli->query("SELECT * FROM Fabricante WHERE Nombre='$id'");

    //if($res->num_rows > 0){
    $row=$res->fetch_assoc();
    //}

    return $row;
}

function getAllProducts($mysqli){
    $res=$mysqli->query("SELECT * FROM Productos");

    //if($res->num_rows > 0){
    $row=$res->fetch_all(MYSQLI_ASSOC);
    //}

    return $row;    
}

?>