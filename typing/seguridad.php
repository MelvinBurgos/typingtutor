<? 
//Reanudamos la sesi�n 
session_start(); 
//Validamos si existe realmente una sesi�n activa o no 
if($_SESSION["autentica"] != "SIP")
{ 
  //Si no hay sesi�n activa, lo direccionamos al index.php (inicio de sesi�n) 
  header("Location: index.php"); 
  exit(); 
} 
?>