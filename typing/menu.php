<?php 
include 'seguridad.php';
include 'conexion.php';
session_start();
GetMyConnection();
mysqli_select_db($g_link,"lessons");
      //recuperar menu de lecciones

     $sql = "SELECT l.lec_id id, l.lec_nombre nombre, t.tip_url turl, a.inicio inicio, a.final final, now() hora
			FROM lecciones_asignadas a, lecciones l, tipos t 
			WHERE a.lec_id = l.lec_id AND l.tip_id = t.tip_id
			AND usr_id = ".$_SESSION['usuarioID']; 
      
	  $resultado = mysqli_query($g_link,$sql);
	  $nmy = mysqli_num_rows($resultado);
	  //$nfilas = mysqli_num_rows($resultado);
	/*  while($row = mysqli_fetch_array($resultado, MYSQLI_NUM))
	{
	$rows[] = $row;
	}*/
?> 
<html> 
<head> 
<title>Typing</title> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head> 
<body>
	<h1>Bienvenido al sistema!</h1> 
	<h2>Usuario: <?php echo $_SESSION['usuarioactual'] ?></h2><br> 
	<!--<h2>Nombre: <?php echo $_SESSION['usrName']." ".$_SESSION['usrLastName']?></h2><br>--> 
<p>Entro correctamente al sistema.</p><br><br>
<a href="notas.php">Ver notas</a> 
<?php  
	if($nmy != 0){ 
	while ($fila = $resultado->fetch_assoc()) {
	//for ($i = 0; $i < $nfilas; $i++){
		$lid = $fila['id'];
		$lnombre = $fila['nombre'];
		$turl = $fila['turl'];
		$s_inicio = strtotime($fila['inicio']);
		$s_final = strtotime($fila['final']);
		$s_hora = strtotime($fila['hora']);
		if ($s_hora > $s_inicio && $s_hora < $s_final )
			echo "<h2>".$lnombre."<a href=\"".$turl.$lid. "\"><img src=\"../images/ClicAqui.jpg\" width=100 height=30 alt=\"Haga clic aqui para comenzar\"></a></h2>";
		else 
			echo "<h2>".$lnombre."<img src=\"../images/ClicAquiBlock.jpg\" width=100 height=30></a></h2>";
     }
	}
	CleanUpDB();
?>
<a href="salir.php">Salir</a> 
</body> 
</html>