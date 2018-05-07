<?php include("seguridad.php");
include 'conexion.php';
GetMyConnection();
mysqli_select_db($g_link, "LESSONS"); 

// El query valida si el usuario ingresado existe en la base de datos. Se utiliza la funci?n htmlentities para evitar inyecciones SQL.
$resultado = mysqli_query($g_link, "INSERT INTO `resultados_lecciones`(`usr_id`, `lec_id`, `inicio`, `final`, `correctas`, 
`tiempo`, `errores`, `nota`, `ppm`, `wpm`, `texto_escrito`) 
VALUES (".htmlentities($_GET["usuario"]).",".htmlentities($_GET["leccion"]).",'".htmlentities($_GET["inicio"]).
"','".htmlentities($_GET["final"])."',".htmlentities($_GET["correctas"]).",".htmlentities($_GET["tiempo"]).
",".htmlentities($_GET["errores"]).",".htmlentities($_GET["nota"]).",".htmlentities($_GET["ppm"]).",".
htmlentities($_GET["wpm"]).",'".htmlentities($_GET["escrito"])."')"); 
if(! $resultado )
{
  die('Ha sucedido un error: ' . mysql_error());
}
echo "�Tu nota ha sido guardada!\n";

CleanUpDB();
echo "<a href='../typing/menu.php'>INICIO</a>"
?>