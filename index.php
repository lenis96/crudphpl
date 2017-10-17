<?php
include ("conexion.php");
include("cls_vehiculo.php");

$vehiculo=new Vehiculo();

if($_POST){
	$vehiculo->id=$_POST["txtId"];
	$vehiculo->matricula=$_POST["txtMatricula"];
	$vehiculo->marca=$_POST["txtMarca"];
	$vehiculo->modelo=$_POST["txtModelo"];
	$vehiculo->color=$_POST["txtColor"];
	$vehiculo->precio=$_POST["txtPrecio"];
	$vehiculo->guardar();
}
else if(isset($_GET["editar"])){
	$vehiculo->id=$_GET["editar"]+0;
	$vehiculo->cargar();
}
else if(isset($_GET["eliminar"])){
	Vehiculo::borrar($_GET["eliminar"]+0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mantenimiento</title>
	<style>
		#tlbVehiculos{
			width:100%;
			border: solid 1px black;
		}
		#tlbVehiculos thead{
			background: black;
			color: white;
		}
	</style>
</head>
<body>
	<form action="index.php" method="POST">
		<table border="1" id="tlbGuardar">
			<tr>
				<th>ID</th>
				<td><input type="text"  value="<?php echo $vehiculo->id; ?>" readonly name="txtId"></td>
			</tr>
			<tr>
				<th>Matricula</th>
				<td><input type="text"  value="<?php echo $vehiculo->matricula; ?>" name="txtMatricula"></td>
			</tr>
			<tr>
				<th>Marca</th>
				<td><input type="text"  value="<?php echo $vehiculo->marca; ?>" name="txtMarca"></td>
			</tr>
			<tr>
				<th>Modelo</th>
				<td><input type="text"  value="<?php echo $vehiculo->modelo; ?>" name="txtModelo"></td>
			</tr>
			<tr>
				<th>Color</th>
				<td><input type="text"  value="<?php echo $vehiculo->color; ?>" name="txtColor"></td>
			</tr>
			<tr>
				<th>Precio</th>
				<td><input type="text"  value="<?php echo $vehiculo->precio; ?>" name="txtPrecio"></td>
			</tr>
			<tr>
				<td><a href="index.php">Nuevo</a></td>
				<td><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
	<fieldset>
		<legend>Registros</legend>
		<table id="tlbVehiculos">
			<thead>
				<th>ID</th>
				<th>Matricula</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Color</th>
				<th>Precio</th>
				<th>Modificar</th>
				<th>Eliminar</th>
			</thead>
			<tbody>
				<?php
					$vehiculos=Vehiculo::lista();
					foreach($vehiculos as $veh){
						$id=$veh['id'];
						echo <<<FILA
							<tr>
								<td>{$veh['id']}</td>
								<td>{$veh['matricula']}</td>
								<td>{$veh['marca']}</td>
								<td>{$veh['modelo']}</td>
								<td>{$veh['color']}</td>
								<td>{$veh['precio']}</td>
								<td><a href='index.php?editar={$id}'>M</a></td>
								<td><a href='index.php?eliminar={$id}'>Eliminar</a></td>
							</tr>
FILA;
					}
				?>
			</tbody>
		</table>
	</fieldset>
</body>
</html>