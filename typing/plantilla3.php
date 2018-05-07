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
	$cadena = str_replace("\"", '\"', $cadena);
	$cadena = str_replace("\r\n", '☺', $cadena);
    return $cadena;
}

?>

<html>
<head> 
<title>LECCIONES</title> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" href="../css/plantillas.css" type="text/css" />
<script src="../js/jquery-2.2.2.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/plantilla3.js"></script>
<script>
   var leccionID = "<?php echo $leccionID;?>";
   var leccion = "<?php echo cambiarCaracter($contenido);?>";
   var usuarioID = "<?php echo $usuarioID;?>";
   var tiempo = "<?php echo $tiempo;?>";
</script>

</head> 
<body>
	<div id="encabezado">
	  <h2>Nombre: <?php echo $_SESSION["usrName"]." ".$_SESSION["usrLastName"] ?> </h1>
	</div>
	<div id="izquierda">
		<?php CleanUpDB(); ?>
	</div>
	<div id="centro">
	<?php
		echo "Hora:".$s_hora."\n";
		echo "Inicio:".$s_inicio."\n";
		if ($s_hora > $s_inicio) echo "Puede comenzar";
		else echo "Aun no puede";
	?>
	</div>
</body> 
</html>