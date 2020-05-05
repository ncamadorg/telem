<?php
// Inicializa la sesion para utilizar variables de sesion
session_start();
// Encabezados html
require('head.php');
?>
<div class="container">

	<?php
	// Conexion a la base de datos
	require ('conn.php');

	// Recibe los datos del formulario de login
	$email = $_POST['email']; // Correo
	$password = $_POST['password']; // Contraseña

	// Realiza la consulta en la base de datos
	$result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

	// La variable $row mantiene el resultado de la consulta a la base de datos
	$row = mysqli_fetch_assoc($result);

	// La variable $hash mantiene la contraseña del usuario que esta guardada en la base de datos
	$hash = $row['password'];

	/*
		Con la funcion password_Verify() se verifica que la contraseña ingresada sea la misma que
		la contraseña que esta almacenada en la base de datos. Si todo esta bien redirecciona al
		espacio de trabajo por 20 minutos; si por el contrario la contraseña es erronea, informa
		al usuario del problema y redirecciona al formulario de inicio de sesion
		*/

	// Valida que las contraseñas sean las misma
	if (password_verify($_POST['password'], $hash)) {

		//inicializa la sesion
		session_start();

		// Define las variables de sesion
		$_SESSION['loggedin'] = true; // Indica que el usuario esta loggeado
		$_SESSION['name'] = $row['name']; // Carga el nombre del usuario a una variable de sesion
		$_SESSION['role'] = $row['role_id']; // Carga el rol del usuario
		$_SESSION['start'] = time(); // Guarda el instante en el que inicion sesion
		$_SESSION['expire'] = $_SESSION['start'] + (1 * 20); // Guarda el limite de la session para 20 min

		// Redirige al espacio de trabajo
		header('Location: ../explorer.php');
	}

	// Si todo sale mal, muestra el error y redirecciona al formulario de inicio de sesion
	else {
		echo "<div class='alert alert-danger mt-4' role='alert'>Correo o contraseña incorrectos!
			<p><a href='../login.php'><strong>Intente nuevamente!</strong></a></p></div>";
	}
	?>
</div>
</body>

</html>