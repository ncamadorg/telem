<?php
// Inicializa la session
session_start();

/* Valida si la sesion existe, permite al usuario acceder a las consultas
  Si el usuario no esta loggeado, redirecciona al formulario de inicio de sesion
*/
if (!$_SESSION['loggedin']) {
  header('Location: login.php');
  exit;
}

// cargamos los roles de usuarios en una variable
$role = $_SESSION['role'];

/* Segun el rol del usuario se carga la dirreccion de la ubicacion de los archivos
  pertenecientes a la dependencia o el rol que desempeña
*/
switch ($role) {
  case '1':
    $dir = 'dist/facturas';
    break;
  case '2':
    $dir = 'dist/informes';
    break;
  case '3':
    $dir = 'dist/cuentas';
    break;
}

/* Se almacena el listado de los archivos en una variable de respuesta para se vizualizada en el
  panel administrativo del usuario
*/

$response = scan($dir);

// Esta funcion busca los archivos y carpetas dentro del directorio definido para cada usuario

function scan($dir)
{

  // Inicializa el arreglo para guardar la informacion
  $files = array();

  // Comprueba la ubicaion de donde realizara la busqueda
  if (file_exists($dir)) {

    // Recorre cada archivo y carpeta separando carpetas y archivos
    foreach (scandir($dir) as $f) {

      // Valida si se trata de archivos ocultos0
      if (!$f || $f[0] == '.') {
        continue; // Ignora archivos ocultos
      }

      // Valida si es un directorio
      if (is_dir($dir . '/' . $f)) {

        // Guarda la informacion de las carpetas en el arreglo definido anteriormente
        $files[] = array(
          "name" => $f, // Nombre de archivo
          "type" => "folder", // Tipo de archivo (Carpeta)
          "path" => $dir . '/' . $f, // Directrio de la acrpeta
          "items" => scan($dir . '/' . $f) // Recursivamente busca subdirectorio dentro del carpeta
        );
      } else {

        // Guarda la informacion del archivo en el arreglo definido anteriormente
        $files[] = array(
          "name" => $f, // Nombre del archivo
          "type" => "file", // tipo de archivo
          "path" => $dir . '/' . $f, // Ubicacion del archivo
          "size" => filesize($dir . '/' . $f) // Tamaño del archivo
        );
      }
    }
  }

  // Retorna el arreglo para manipular la variable
  return $files;
}

// Se convierte la el arreglo en un objeto JSON para ser trasnportado por AJAX
// Encabeezados HTTP.JSON
header('Content-type: application/json');

// Envia el arreglo en formato JSON para que sea leido a traves de HTTP
echo json_encode(array(
  "items" => $response
));
