<?php
class Conexion{
	private static $objCon=null;
	private static $instancia=null;
	public static function obtenerInstancia(){
		if(self::$objCon==null){
			self::$instancia=new Conexion();
			self::$objCon=mysqli_connect("localhost","prueba","PRUEBA","prueba");
		}
		return self::$objCon;
	}
	function __destruct(){
		mysqli_close(conexion::obtenerInstancia());
	}
}
$rs=conexion::obtenerInstancia();
?>