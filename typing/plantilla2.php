<?php 
include("seguridad.php");
include 'conexion.php';
session_start();
GetMyConnection();
mysqli_select_db($g_link,"LESSONS");

// El query valida si el usuario ingresado existe en la base de datos. Se utiliza la funci�n htmlentities para evitar inyecciones SQL.
$sql = "SELECT l.lec_id id, l.lec_contenido contenido, a.tiempo tiempo, a.usr_id user 
		FROM lecciones_asignadas a, lecciones l 
		WHERE a.lec_id = l.lec_id 
		AND l.lec_id = ".htmlentities($_GET["leccion"]).
		" AND usr_id = ".htmlentities($_SESSION["usuarioID"]);

$resultado= mysqli_query($g_link,$sql); 
$nresultado = mysqli_num_rows($resultado);
while ($fila = $resultado->fetch_assoc()) {
	$leccionID = $fila['id'];
	$contenido = $fila['contenido'];
	$tiempo = $fila['tiempo'];
	$usuarioID = $fila['user'];
}

function cambiarCaracter($cadena)
{
	$cadena = str_replace("\"", '\"', $cadena);
	$cadena = str_replace("\r\n", '☺', $cadena);
    return $cadena;
}

?>

<html>
<head> 
<title>leccion</title> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" href="../css/typing.css" type="text/css" />
<script src="../js/jquery-2.2.2.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/plantilla2.js"></script>
<script>
   var leccionID = "<?php echo $leccionID;?>";
   var leccion = "<?php echo cambiarCaracter($contenido);?>";
   var usuarioID = "<?php echo $usuarioID;?>";
   var tiempo = "<?php echo $tiempo;?>";
</script>

</head> 
<body>
  <div id="Contaner">
	<div id="Encabezado">
	  <h1>Bienvenido al sistema!</h1>
	  <h2>Nombre: <?php echo $_SESSION["usrName"]." ".$_SESSION["usrLastName"] ?> </h1>
	  <h2>LECCION ELEGIDA: <?php echo $_GET["leccion"] ?> </h2>
	</div>
	<div id="Capas">
      <div id="texto" class="slide"><br></div>
	  <br>
	  <div id="count" class="contador" >delay</div>
		<a href="menu.php">Menu</a>
		<?php CleanUpDB(); ?>
	</div>
	<div id="CapaFinal">
		<form action="guardarResultados.php" method="get">
	    <input id="usuario" type="hidden" name="usuario">
		<input id="leccion" type="hidden" name="leccion">
		<table>
			<tr>
				<td>Hora Inicio:</td><td><input id="inicio" type="text" name="inicio" readonly="readonly"></td>
			</tr>
			<tr>
				<td>Hora Final:</td><td><input id="final" type="text" name="final" readonly="readonly"></td>
			</tr>
			<tr>
				<td>Correctas:</td><td><input id="correctas" type="text" name="correctas" readonly="readonly"></td>
			</tr>
			<tr>
				<td>Tiempo transcurrido:</td><td><input id="tiempo" type="text" name="tiempo" readonly="readonly"></td>
			</tr>
			<tr>
				<td>errores:</td><td><input id="errores" type="text" name="errores" readonly="readonly"></td>
			</tr>
			<tr>
				<td>Nota:</td><td><h1><input id="nota" type="text" name="nota" readonly="readonly"></h1></td>
			</tr>
			<tr>
				<td>Pulsaciones por minuto:</td><td><input id="ppm" type="text" name="ppm" readonly="readonly"></td>
			</tr>
			<tr>
				<td>Palabras por minuto:</td><td><input id="wpm" type="text" name="wpm" readonly="readonly"><td>
			</tr>
			<tr>
				<td><input type="button" value="Repetir" onclick="javascript:window.location.reload();"/></td>
				<td><input type="submit" value="Guardar resultados"></td>
			</tr>
		</table>
		<div><input id="escrito" type="hidden" name="escrito"></input></div>
		</form>
	</div>
  </div>
</body> 
</html>