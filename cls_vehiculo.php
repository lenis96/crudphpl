<?php
class Vehiculo{
	private $id=0;
	private $matricula="";
	private $marca="";
	private $modelo="";
	private $color="";
	private $precio="";
	public function __get($atributo){
		return $this->$atributo;
	}
	public function __set($atributo,$valor){
		$this->$atributo=$valor;
	}
	function guardar(){
		if($this->id>0){
			$sql="update vehiculo set
			matricula='{$this->matricula}',
			marca='{$this->marca}',
			modelo='{$this->modelo}',
			color='{$this->color}',
			precio='{$this->precio}'
			where id='{$this->id}'";
			mysqli_query(conexion::obtenerInstancia(),$sql);
		}else{
			$sql="insert into vehiculo(matricula,marca,modelo,color,precio) values
			('{$this->matricula}',
				'{$this->marca}',
				'{$this->modelo}',
				'{$this->color}',
				'{$this->precio}')";
			mysqli_query(conexion::obtenerInstancia(),$sql);
		}
	}
	function cargar(){
		$consulta="select * from vehiculo where id={$this->id}";
		$rs=mysqli_query(conexion::obtenerInstancia(),$consulta);
		if(mysqli_num_rows($rs)>0){
			$fila=mysqli_fetch_assoc($rs);
			$this->matricula=$fila['matricula'];
			$this->marca=$fila['marca'];
			$this->modelo=$fila['modelo'];
			$this->color=$fila['color'];
			$this->precio=$fila['precio'];
		}
	}
	static function lista(){
		$data=array();
		$consulta="select * from vehiculo";
		$rs=mysqli_query(conexion::obtenerInstancia(),$consulta);
		if(mysqli_num_rows($rs)>0){
			while($fila=mysqli_fetch_assoc($rs)){
				$data[]=$fila;
			}
		}
		return $data;
	}
	static function borrar($id){
		$sql="delete from vehiculo where id={$id}";
		mysqli_query(conexion::obtenerInstancia(),$sql);
	}
}
?>