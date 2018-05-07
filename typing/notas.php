<?php include("seguridad.php");
include 'conexion.php';
session_start();
GetMyConnection();
mysqli_select_db($g_link, "LESSONS");

$sql = "SELECT lec.lec_nombre leccion, ifnull(res.nota,0) nota 
        FROM lecciones lec 
        INNER JOIN lecciones_asignadas asi ON asi.lec_id = lec.lec_id 
        LEFT OUTER JOIN 
        (SELECT re.usr_id, re.lec_id, max(re.nota) nota 
          FROM resultados_lecciones re 
          WHERE re.usr_id = ".$_SESSION['usuarioID'].
          " GROUP BY re.lec_id) res 
            ON res.lec_id =  asi.lec_id 
            WHERE asi.usr_id = ".$_SESSION['usuarioID'].
            " ORDER BY asi.lec_id desc";

$resultado= mysqli_query($g_link, $sql);
$nr = mysqli_num_rows($resultado);
?>

<html>
<head> 
<title>leccion</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="../css/typing.css" type="text/css" />
<script src="../js/jquery-2.2.2.min.js"></script>
<script src="../js/leccion.js"></script>

</head> 
<body>
  <div id="Contenedor">
<h1>NOTAS DE LECCIONES</h1>
		<table border=1>
<?php
echo "<tr><th>Lección</th><th>Nota</th></tr>";
if($nr != 0){ 
  while($rows = $resultado->fetch_assoc()){ 
    echo "<tr>";
    echo "<td>".$rows['leccion']."</td>"; 
    echo "<td>".$rows['nota']."</td>"; 
    echo "<tr>";
  }
}
?>
		</table>
<BR><a href="menu.php">Menu</a>
  </div>
</body>
</html>