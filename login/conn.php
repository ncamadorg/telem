<?php
// Variables para la conexion a la base de datos
$dbhost	= "localhost";	   // Host de la base de datos
$dbuser	= "admin";		  // Usuario de la base de datos
$dbpass	= "root1234";		     // Contraseña de la base de datos
$dbname	= "test";    // Nombre de la base de datos

//Conexion a la base de datos
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Verifica la conexion
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
?>