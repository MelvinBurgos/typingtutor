<?php
//Constantes de conexi�n
define('db_host','localhost:3306');//Direcci�n IP del MySQL
define('db_user','root');//Usuario administrador
define('db_pwd','');//Contrase�a
define('database','lessons');//Nombre de la base de datos

$g_link = false;

    function GetMyConnection()
    {
        global $g_link;
        if( $g_link )
            return $g_link;
        $g_link = mysqli_connect(db_host, db_user, db_pwd) or die('Could not connect to server.' );
        mysqli_select_db($g_link,database) or die('Could not select database.');
        return $g_link;
    }
    
    function CleanUpDB()
    {
        global $g_link;
        if( $g_link != false )
            mysqli_close($g_link);
    }
?>