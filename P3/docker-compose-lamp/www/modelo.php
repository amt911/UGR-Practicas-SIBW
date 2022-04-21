<?php

class Modelo{
    private $mysqli;

    function __construct(){
        $this->conectarDB();
    }

    function getMySQLi(){
        return $this->$mysqli;
    }

    private function conectarDB(){
        $this->$mysqli=new mysqli("mysql", "usuario", "usuario", "docker");
    
        if($mysqli->connect_errno){
            echo("Fallo al conectar: ". $mysqli->connect_error);
            $this->$mysqli=-1;
        }
    }

    //Hace falta dejarlo mejor para evitar inyeccion
    function getProducto($id){
        $res=$this->$mysqli->query("SELECT * FROM Productos WHERE ID=$id");
    
        //if($res->num_rows > 0){
        $row=$res->fetch_assoc();
        //}
    
        return $row;
    }

    function getFabrica($id){
        $res=$this->$mysqli->query("SELECT * FROM Fabrica WHERE ID='$id'");
    
        //if($res->num_rows > 0){
        $row=$res->fetch_assoc();
        //}
    
        return $row;    
    }

    function getFabricante($id){
        $res=$this->$mysqli->query("SELECT * FROM Fabricante WHERE Nombre='$id'");
    
        //if($res->num_rows > 0){
        $row=$res->fetch_assoc();
        //}
    
        return $row;
    }

    function getAllProducts(){
        $res=$this->$mysqli->query("SELECT * FROM Productos;");
        //if($res->num_rows > 0){
        $row=$res->fetch_all(MYSQLI_ASSOC);
        //}
    
        return $row;    
    }
    
    function getAllComments($idProducto){
        $query=$this->$mysqli->query("SELECT * FROM Tiene,Comentario WHERE ID=ID_Comentario AND ID_Producto=$idProducto;");
    
        $res=$query->fetch_all(MYSQLI_ASSOC);
    
        return $res;
    }
    
    function getNumFilasProducto(){
        $query=$this->$mysqli->query("SELECT COUNT(*) FROM Productos");
    
        //if($res->num_rows > 0){
        $res=$query->fetch_assoc();
        //}
    
        return $res["COUNT(*)"];
    }
    
    function getComentarios($id){
        $query=$this->$mysqli->query("SELECT * FROM Comentario,Tiene WHERE ID_Producto=1 AND ID=$id;");
    
        $res=$query->fetch_all(MYSQLI_ASSOC);
    
        return $res;
    }
    
    function getPalabrotas(){
        $query=$this->$mysqli->query("SELECT * FROM Palabrota;");
    
        $resultado=$query->fetch_all();
    
        $salida=array();
    
        foreach ($resultado as $i) {
            foreach($i as $j){
                $salida[]=$j;
            }
        }
    
        return $salida;
    }
}
?>