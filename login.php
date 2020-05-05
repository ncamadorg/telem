<?php
session_start();
if ($_SESSION['loggedin']) {
  header('Location: explorer.php');
  exit;
}
require('login/head.php');
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="loginBox">
          <img src="images/logo-symbol.png" class="img-responsive"/>
          <h2>Login</h2>

          <form action="login/check-login.php" method="post">
            <div class="form-group">
              <input type="email" class="form-control input-lg" name="email" placeholder="Email" required />
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" name="password" placeholder="Password" required />
            </div>
            <button type="submit" class="btn btn-success btn-block">
              Login
            </button>
          </form>
          <!-- Collapse a form when user click Lost your password? link-->
          <p>
            <a href="#showForm" data-toggle="collapse" aria-expanded="false" aria-controls="collapse">Perdio su contraseña?</a>
          </p>
          <div class="collapse" id="showForm">
            <div class="well">
              <form action="password-recovery.php" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Enter the email associated with the password." required />
                </div>
                <button type="submit" class="btn btn-dark">
                  Recuperar contraseña
                </button>
              </form>
            </div>
          </div>

          <hr />
          <p>
            Nuevo usuario?
            <a href="index.php" title="Crear cuenta">Crear una cuenta</a>
          </p>
        </div>
        <!-- /.loginBox -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!--/.row-->
</div>
<!-- /.container -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>