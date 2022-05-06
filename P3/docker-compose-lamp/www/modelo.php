<?php

class Modelo{
    private $mysqli;
    private $MAX_PAGE;

    function __construct(){
        $this->MAX_PAGE=9;
        $this->conectarDB();
    }

    function getMySQLi(){
        return $this->mysqli;
    }

    private function conectarDB(){
        $this->mysqli=new mysqli("mysql", "usuario", "usuario", "SIBW");
    
        if($this->mysqli->connect_errno){
            echo("Fallo al conectar: ". $this->mysqli->connect_error);
            $this->mysqli=-1;
        }
    }

    //Hace falta dejarlo mejor para evitar inyeccion
    function getProducto($id){
        $row=false;

        $prepare=$this->mysqli->prepare("SELECT * FROM ProductosFabrica WHERE ID=?");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $res=$prepare->get_result();
    
        if($res->num_rows > 0)
            $row=$res->fetch_assoc();
    
        return $row;
    }

    function getFabrica($id){
        $row=false;

        $prepare=$this->mysqli->prepare("SELECT * FROM Fabrica WHERE ID=?");
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

        $prepare=$this->mysqli->prepare("SELECT * FROM Fabricante WHERE Nombre=?");
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
        
        $res=$this->mysqli->query("SELECT * FROM Productos;");
        
        if($res->num_rows > 0){
            $row=$res->fetch_all(MYSQLI_ASSOC);
        }
    
        return $row;    
    }
    
    function getNumPaginas(){
        $salida=$this->getNumFilasProducto();

        $res=intval($salida/$this->MAX_PAGE);

        if($salida%$this->MAX_PAGE != 0)
            $res++;

        return $res;
    }

    function getAllComments($idProducto){
        $res=false;

        $this->mysqli->query("SET lc_time_names='es_ES';");
        $prepare=$this->mysqli->prepare("SELECT Nombre,DATE_FORMAT(Fecha, '%d de %M del %Y, %k:%i') AS Fecha,Texto,Correo FROM ComentarioTiene WHERE ID_Producto=?;");
        $prepare->bind_param("i", $idProducto);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);

        return $res;
    }
    
    private function getNumFilasProducto(){
        $res=false;
        
        $query=$this->mysqli->query("SELECT COUNT(*) FROM ProductosFabrica");
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }
    
        return $res;
    }
    
    function getComentarios($id){
        $res=false;

        $prepare=$this->mysqli->prepare("SELECT * FROM Comentario,Tiene WHERE ID_Producto=1 AND ID=?;");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $res=$prepare->get_result();
    
        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);
    
        return $res;
    }
    
    function getPalabrotas(){
        $salida=false;

        $query=$this->mysqli->query("SELECT * FROM Palabrota;");
    
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

        $prepare=$this->mysqli->prepare("SELECT * FROM Imagenes WHERE ID_Producto=?;");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);
    
        return $res;        
    }

    function getProductsPage($a){
        if($a<=0 or $a>$this->getNumPaginas())
            $a=1;
        
        $res=false;

        $min=($a-1)*9;
        //$max=$min+8;

        //$prepare=$this->mysqli->prepare("SELECT * FROM Productos WHERE ID BETWEEN ? AND ?");
        $prepare=$this->mysqli->prepare("SELECT * FROM ProductosFabrica ORDER BY ID LIMIT ?, ?");
        $prepare->bind_param("ii", $min, $this->MAX_PAGE);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);

        return $res;
    }

    function existeProducto($id){
        $res=false;

        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM ProductosFabrica WHERE ID=?");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        return $res;
    }
}

//La sentencia que hay que usar es:
//SELECT * FROM Productos WHERE ID BETWEEN 3 AND 7;
?>