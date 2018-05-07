<html> 
<head> 
<title>Inicio de sesión</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="../css/index.css" type="text/css" />
<script src="../js/jquery-2.2.2.min.js"></script>
<script src="../js/jquery-ui.js"></script>
    <script>
      $(document).ready(function () {
        $('#mostrar').click(function () {
          if ($('#mostrar').is(':checked')) {
            $('#clave').attr('type', 'text');
          } else {
            $('#clave').attr('type', 'password');
          }
        });
      });
	</script>
</head>
<body>
	<div class="container">
		<div class="login">
			<form action="control.php" method="post" id="form">
				<table>
				<tr>
					<td>Usuario:</td><td><input type="text" name="usuario" id="usuario" /></td>
				</tr>
				<tr>
					<td>Clave:</td><td><input type="password" name="clave" id="clave" />
					<input type="checkbox" id="mostrar" name="mostrar" /></td>
					<td></td><td><input type="submit" value="Entrar"></td>
				</tr>
				</table>
			</form>
		</div>
	</div>
</body> 
</html>