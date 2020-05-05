<?php
//Encabezados html
require('head.php');

//Conexion a la base de datos
require ('conn.php');

// Consulta para verificar si el correo esta registrado
$checkEmail = "SELECT * FROM user WHERE email = '$_POST[email]'";

// La variable $result guarda la conexion a la base de datos mientras se realiza la consulta
$result = $conn->query($checkEmail);

// La variable $count mantiene el resultado de la consulta a la base de datos
$count = mysqli_num_rows($result);

// Si el correo electronico esta registrado, avisa al usuario para que inicie sesion
if ($count == 1) {
	echo "<div class='alert alert-warning mt-4' role='alert'>
			<p>El usuario ya esta registrado</p>
		</div>";

		// Hace una pausa de 3 segundos y luego redirige a la pagina de inicio de sesion
		sleep(3);
		header('Location: ../login.php');
}

else {

	/*
Si el correo no se encuentra registrado, guarda los datos intriducidos en el formulario de regiustro en la base de datos
*/
	$name = $_POST['name']; // Nombre
	$email = $_POST['email']; // Correo
	$pass = $_POST['password']; // Contraseña
	$role = $_POST['role']; // Rol o departamento al que pertenece

	// Se encripta la contraseña para evitar problemas de seguridad
	$passHash = password_hash($pass, PASSWORD_DEFAULT);

	// Se realiza la consulta que almacena la informacion a la base de datos
	$query = "INSERT INTO user (id, name, email, password, role_id) VALUES (null, '$name', '$email', '$passHash', $role)";

	// Si todo salio bien, redirige al usuario a la pagina de inicio de sesion
	if (mysqli_query($conn, $query)) {
		header('Location: ../login.php');
	}

	// Si hay problemas en la consulta de insercion de datos, muestra el error y redirige nuevamente a la pagina de registro
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($conn);
		sleep(3);
		header('Location: ../index.php');
	}
}

// Finalizadas las tareas con la base de datos, cierra la conexion.
mysqli_close($conn);
?>