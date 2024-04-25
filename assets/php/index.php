<?php 

	$conexion=mysqli_connect('localhost','root','','pruebas');

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>mostrar datos</title>
</head>
<body>

<br>

	<table border="1" >
		<tr>
			<td>Nombre</td>
			<td>Apellidos</td>
			<td>Categoria</td>
			<td>Club</td>
			<td>Genero</td>	
		</tr>

		<?php 
		$sql="SELECT * from t_persona";
		$result=mysqli_query($conexion,$sql);

		while($mostrar=mysqli_fetch_array($result)){
		 ?>

		<tr>
			<td><?php echo $mostrar['Nombre'] ?></td>
			<td><?php echo $mostrar['Apellidos'] ?></td>
			<td><?php echo $mostrar['Categoria'] ?></td>
			<td><?php echo $mostrar['Club'] ?></td>
			<td><?php echo $mostrar['Genero'] ?></td>
		</tr>
	<?php 
	}
	 ?>
	</table>

</body>
</html>