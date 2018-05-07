<?php 
// A continuación, realizamos la conexión con nuestra base de datos en MySQL
include 'conexion.php';
ini_set('session.gc_maxlifetime', 50*60); // variable de tiempo de session a 50 minutos
GetMyConnection();
mysqli_select_db($g_link,"lessons");

// El query valida si el usuario ingresado existe en la base de datos. Se utiliza la función htmlentities para evitar inyecciones SQL.
$myusuario = mysqli_query($g_link,"select usr_id from usuarios where usr_name = '".htmlentities($_POST["usuario"])."'"); 
$nmyusuario = mysqli_num_rows($myusuario); 

//Si existe el usuario, validamos tambi�n la contrase�a ingresada y el estado del usuario... 
if($nmyusuario != 0)
{ 
  $sql = "SELECT usr_id, usr_name, usr_first_name, usr_father_surname FROM usuarios WHERE usr_status = 1 and usr_name = '".htmlentities($_POST["usuario"])."' and usr_password = '".htmlentities($_POST["clave"])."'"; 
  $resultado = mysqli_query($g_link,$sql);
  $nmyclave = mysqli_num_rows($resultado); 

  //Si el usuario y clave ingresado son correctos (y el usuario est� activo en la BD), creamos la sesi�n del mismo. 
  if($nmyclave != 0)
  { 
      session_start(); 
      //Guardamos dos variables de sesi�n que nos auxiliar� para saber si se est� o no "logueado" un usuario 
      while ($fila = $resultado->fetch_assoc()) {
      $_SESSION['autentica'] = "SIP";
	  $_SESSION['usuarioID'] = $fila['usr_id'];
      $_SESSION['usuarioactual'] = $fila['usr_name'];   //nombre del usuario logueado.
	  $_SESSION['usrName'] = $fila['usr_first_name'];
	  $_SESSION['usrLastName'] = $fila['usr_father_surname'];
      }
      //Direccionamos a nuestra p�gina principal del sistema.
      header ("Location: menu.php");
    }
   else{ 
      echo "<script>alert('La contrasena del usuario no es correcta.'); window.location.href=\"index.php\"</script>"; 
   } 
}
else
{ 
    echo "<script>alert('El usuario no existe.'); window.location.href=\"index.php\"</script>"; 
}

CleanUpDB();
?>