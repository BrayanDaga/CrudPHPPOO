<?php

	class Database{
		private $conn;
		private $servername = "localhost";
		private $username = "root";
		private $password = "";
		private $myDB="test_empleados";
        
		function __construct(){
			$this->connect_db();
        }
        
		public function connect_db(){
			try {
		    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->myDB", $this->username, $this->password);
		    // set the PDO error mode to exception
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    //echo "Conectado exitosamente";
		    }
		catch(PDOException $e)
		    {
		    echo "Error de conexión: " . $e->getMessage();
		    }
        }
       
    	 public function read(){
        	$sql = "SELECT * FROM empleados ORDER BY codigo ASC";
        	$stmt = $this->conn->prepare($sql);
    		  $stmt->execute();
          return $stmt;
        }
       
       

       public function delete($codigo){
          $sql = "DELETE FROM empleados WHERE codigo=?";
  			   $stmt = $this->conn->prepare($sql);
  		  	 $stmt->execute(array($codigo));
		  	   if($stmt){
            return true;
            }else{
            return false;
            }
            
       }

       public function create($codigo,$nombres,$lugar_nacimiento,$fecha_nacimiento,$direccion,$telefono,$puesto,$estado){
       		$sql = "INSERT INTO empleados (codigo, nombres, lugar_nacimiento,fecha_nacimiento, direccion, telefono, puesto, estado) VALUES (?,?,?,?,?,?,?,?)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array($codigo,$nombres,$lugar_nacimiento,$fecha_nacimiento,$direccion,$telefono,$puesto,$estado));
       		if($stmt){
            return true;
            }else{
            return false;
            }
       }

       public function single_record($codigo){
   			$sql = "SELECT * FROM empleados where codigo=?";
      	$stmt = $this->conn->prepare($sql);
    		$stmt->execute(array($codigo));
        	$res = $stmt->fetch(PDO::FETCH_OBJ);
        	return $res;
       }

        public function filter($filter){
          $sql="SELECT * FROM empleados WHERE estado=? ORDER BY codigo ASC";
          $stmt=$this->conn->prepare($sql);
          $stmt->execute(array($filter));
          return $stmt;
        }

       public function num_rows(){
        $sql="SELECT COUNT(*) as filas from empleados";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetch(PDO::FETCH_OBJ);
        return $res;
       }

       public function num_rows_ById($codigo){
        $sql="SELECT COUNT(*) as filas from empleados where codigo=?";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(array($codigo));
        $res=$stmt->fetch(PDO::FETCH_OBJ);
        return $res;
       }


       public function update($codigo,$nombres,$lugar_nacimiento,$fecha_nacimiento,$direccion,$telefono,$puesto,$estado,$nik){
	          $sql="UPDATE empleados SET codigo=?, nombres=?, lugar_nacimiento=?, fecha_nacimiento=?, direccion=?, telefono=?, puesto=? ,estado=? WHERE codigo=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->execute(array($codigo,$nombres,$lugar_nacimiento,$fecha_nacimiento,$direccion,$telefono,$puesto,$estado,$nik));
			if($stmt){
            return true;
            }else{
            return false;
            }
       }
}
?>