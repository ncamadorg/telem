<?php
require('login/head.php');
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">

			<?php
			// Conexion a la base de datos
			require('conn.php');

			// Consulta si el correo esta registrado
			$sql = "SELECT email, password FROM user WHERE email='$email'";
			// Guarda la cnsulta
			$result = mysqli_query($conn, $sql);

			// Valida si hay resultados en la busqueda
			if (mysqli_num_rows($result) > 0) {
				// Almacena los datos de la consulta
				$row = mysqli_fetch_assoc($result);

				// Compone el correo para recuperar la contraseña
				// Asunto del correo
				$subject = "Recuperar contraseña";

				// Cuerpo del correo
				$body = "Tu contraseña es: " . $row['password'];

				// Informacion del servidor
				$headers = 'From: sucorreo@mail.com' . "\r\n" .
					'Reply-To: sucorreo@mail.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

				// Envia el correo
				mail($email, $subject, $body, $headers);

				// Informa que el correo se ha enviado exitosamente
				echo "<div class='alert alert-success alert-dismissible mt-4' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Cerrar'>
				<span aria-hidden='true'>&times;</span></button>

				<p>Correo enviado con exito, revise su bandeja de entrada o carpeta de Spam</p>
				<p><a class='alert-link' href=../login.php>Login</a></p></div>";
			} else {
				// Informa al usuario que el correo no se encuentra registrado y redirecciona a la pagina de registro
				echo "<p>El correo ingresado no se encuentra registrado</p>
				<p><a class='alert-link' href=../index.php>Registrarse</a></p></div>";
			}
			?>
		</div>
	</div>
</div>
</body>

</html>