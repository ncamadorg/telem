<?php
require('login/head.php');
?>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h1>Administrador de archivos</h1>
      <p>
        Control de acceso sistema de gestión
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
      <h3>Crear una cuenta</h3>
      <hr />

      <form method="post" action="login/create-account.php" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" name="name" placeholder="Ingrese su nombre" required />
        </div>

        <div class="form-group">
          <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Ingrese su email" required />
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Cree una contraseña" required />
        </div>

        <div class="form-group">
          <select name="role">
            <option value="1">Facturación</option>
            <option value="2">Informes trimestrales</option>
            <option value="3">Cuentas por pagar</option>
          </select>
        </div>

        <button type="submit" class="btn btn-success btn-block">
          Crear mi cuenta
        </button>
      </form>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
      <h3>Login</h3>
      <hr />
      <p>
        Ya tiene una cuenta?
        <a href="login.php" title="Login Here">Ingrese aqui!</a>
      </p>
    </div>
  </div>
</div>
</body>
</html>