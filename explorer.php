<?php
// inicializa la sesion
session_start();
// Si el usuario esta loggeado permite el acceso, sino lo redirecciona al inicio de sesion
if (!$_SESSION['loggedin']) {
  header('Location: login.php');
  exit;
}

// Comprueba que la sesion no haya expirado, si es el caso redirecciona al incio de sesion
$now = time();
if ($now > $_SESSION['expire']) {
  // Se destruye la sesion
  session_destroy();
  header('Location: login.php');
  exit;
}

// encabezados HTML
require('login/head.php');
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="images/logo-symbol.png" class="img-responsive" width="60px;"/> Sistema de gestión</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="col-11"></div>
      <div class="col-1">
        <a href="login/logout.php">Salir</a>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h1>Bienvenido/a <?php echo $_SESSION['name']; ?></h1>
  <div id="app">
    <div class="container">
      <div class="table-responsive-sm">
        <table class="table table-sm table-hover table-striped">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Tipo</th>
              <th scope="col">Tamaño</th>
              <th scope="col">Directorio</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="file in files" :key="file.id">
              <th class="text-truncate" scope="row"><a :href="file.path" v-text="file.name" target="_blank"></a></th>
              <td v-text="file.type"></td>
              <td v-text="file.size + ' Bytes'"></td>
              <td class="text-truncate" v-text="file.path"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/vuex@3.3.0/dist/vuex.js"></script>
<script src="script.js"></script>
</body>

</html>