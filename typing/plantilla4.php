<?php 
include("seguridad.php");
include 'conexion.php';
session_start();
GetMyConnection();
mysqli_select_db($g_link,"LESSONS");

// El query valida si el usuario ingresado existe en la base de datos. Se utiliza la funci�n htmlentities para evitar inyecciones SQL.
$sql = "SELECT l.lec_id id, l.lec_contenido contenido, a.tiempo tiempo, a.usr_id user, 
		a.inicio inicio, a.final final, now() hora 
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
	$s_inicio = strtotime($fila['inicio']);
	$s_final = strtotime($fila['final']);
	$s_hora = strtotime($fila['hora']);
}

function cambiarCaracter($cadena)
{
	//$cadena = iconv('ISO-8859-1','UTF-8//TRANSLIT',$cadena);
	$cadena = str_replace("\"", '\"', $cadena);
	$cadena = str_replace("\r\n", '☺', $cadena);
    return $cadena;
}

?>

<html>
<head> 
<title>LECCIONES</title> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" href="../css/plantilla4.css" type="text/css" />
<script src="../js/jquery-2.2.2.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/plantilla4.js"></script>
<script>
   var leccionID = "<?php echo $leccionID;?>";
   var leccion = "<?php echo cambiarCaracter($contenido);?>";
   var usuarioID = "<?php echo $usuarioID;?>";
   var tiempo = "<?php echo $tiempo;?>";
</script>

</head> 
<body>
	<div id="encabezado">
   	  <h1>Usuario: <?php echo $_SESSION["usuarioactual"] ?> </h1>
	  <h2>Nombre: <?php echo $_SESSION["usrName"]." ".$_SESSION["usrLastName"] ?> </h1>
	</div>
	<div id="cuerpo">
	<div id="modelo"></div>
	</div>
<!--	<div class="linea">
		<p class="tecla">q</p>
		<p class="tecla">w</p>
		<p class="tecla">e</p>
		<p class="tecla">r</p>
		<p class="tecla">t</p>
		<p class="tecla">y</p>
		<p class="tecla">u</p>
		<p class="tecla">i</p>
		<p class="tecla">o</p>
		<p class="tecla">p</p>
	</div>
	<div class="linea">
		<p class="tecla">a</p>
		<p class="tecla">s</p>
		<p class="tecla">d</p>
		<p class="tecla">f</p>
		<p class="tecla">g</p>
		<p class="tecla">h</p>
		<p class="tecla">j</p>
		<p class="tecla">k</p>
		<p class="tecla">l</p>
		<p class="tecla">ñ</p>
	</div>
	<div class="linea">
		<p class="tecla">z</p>
		<p class="tecla">x</p>
		<p class="tecla">c</p>
		<p class="tecla">v</p>
		<p class="tecla">b</p>
		<p class="tecla">n</p>
		<p class="tecla">m</p>
		<p class="tecla">,</p>
		<p class="tecla">.</p>
		<p class="tecla">-</p>
	</div>
	<div class="linea">
		<p class="espacio">espacio</p>
	</div>-->
	<div id="contador"></div>
	<div id="mensaje">Advertencia, mayúsculas activadas</div>
		<div id="resultado">
		<form action="guardarResultados.php" method="get">
	    <input id="usuario" type="hidden" name="usuario">
		<input id="leccion" type="hidden" name="leccion">
		<input id="inicio" type="hidden" name="inicio">
		<input id="final" type="hidden" name="final">
		<table>
			<tr>
				<td>Correctas:</td><td><input id="correctas" type="text" name="correctas" readonly="readonly"></td>
			</tr>
			<tr>
				<td>errores:</td><td><input id="errores" type="text" name="errores" readonly="readonly"></td>
			</tr>
			<tr>
				<td>Tiempo transcurrido:</td><td><input id="tiempo" type="text" name="tiempo" readonly="readonly"></td>
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
	<?php CleanUpDB(); ?>
</body> 
</html>