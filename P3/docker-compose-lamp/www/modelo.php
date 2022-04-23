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
        $row=false;

        $prepare=$this->$mysqli->prepare("SELECT * FROM Productos WHERE ID=?");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $res=$prepare->get_result();
    
        if($res->num_rows > 0)
            $row=$res->fetch_assoc();
    
        return $row;
    }

    function getFabrica($id){
        $row=false;

        $prepare=$this->$mysqli->prepare("SELECT * FROM Fabrica WHERE ID=?");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $res=$prepare->get_result();

        if($res->num_rows > 0){
            $row=$res->fetch_assoc();
        }
    
        return $row;    
    }

    function getFabricante($id){
        $row=false;

        $prepare=$this->$mysqli->prepare("SELECT * FROM Fabricante WHERE Nombre=?");
        $prepare->bind_param("s", $id);
        $prepare->execute();

        $res=$prepare->get_result();
    
        if($res->num_rows > 0){
            $row=$res->fetch_assoc();
        }
    
        return $row;
    }

    function getAllProducts(){
        $row=false;
        
        $res=$this->$mysqli->query("SELECT * FROM Productos;");
        
        if($res->num_rows > 0){
            $row=$res->fetch_all(MYSQLI_ASSOC);
        }
    
        return $row;    
    }
    
    function getAllComments($idProducto){
        $res=false;

        $this->$mysqli->query("SET lc_time_names='es_ES';");
        $prepare=$this->$mysqli->prepare("SELECT Nombre,DATE_FORMAT(Fecha, '%d de %M del %Y, %k:%i') AS Fecha,Texto,Correo FROM Tiene,Comentario WHERE ID=ID_Comentario AND ID_Producto=?;");
        $prepare->bind_param("i", $idProducto);
        $prepare->execute();

        $res=$prepare->get_result();
    
        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);

        return $res;
    }
    
    function getNumFilasProducto(){
        $res=false;
        
        $query=$this->$mysqli->query("SELECT COUNT(*) FROM Productos");
    
        if($query->num_rows > 0)
            $res=$query->fetch_assoc();
    
        return $res["COUNT(*)"];
    }
    
    function getComentarios($id){
        $res=false;

        $prepare=$this->$mysqli->prepare("SELECT * FROM Comentario,Tiene WHERE ID_Producto=1 AND ID=?;");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $res=$prepare->get_result();
    
        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);
    
        return $res;
    }
    
    function getPalabrotas(){
        $salida=false;

        $query=$this->$mysqli->query("SELECT * FROM Palabrota;");
    
        if($query->num_rows > 0){
            $resultado=$query->fetch_all(MYSQLI_ASSOC);
        
            $salida=array();
        
            foreach ($resultado as $i) {
                foreach($i as $j){
                    $salida[]=$j;
                }
            }
        }
    
        return $salida;
    }

    function get_imagenes_comentarios($id){
        $aux=$this->getProducto($id);
        $res=false;

        $array_i=preg_split("/\R/", $aux["Imagenes"]);
        $array_c=preg_split("/\R/", $aux["Comentarios"]);

        if(count($array_c)==count($array_i)){
            $res=array_combine($array_i, $array_c);
        }

        return $res;
    }    

    function get_imagenes($id){  
        $res=false;

        $prepare=$this->$mysqli->prepare("SELECT * FROM Imagenes WHERE ID_Producto=?;");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);
    
        return $res;        
    }
}
?>