<?php
session_start();

//1. Obteniendo nivel de acceso (LOGIN)
$nivelacceso = $_SESSION['login']['nivelacceso'];
//$nivelacceso = "AST";   //ADM - SPV - AST

//2. Obtener el nombre de la vista
$url = $_SERVER['REQUEST_URI'];
$url_array = explode("/", $url);
$vistaActiva = $url_array[count($url_array) - 1];

//3. Definir los permisos
$permisos = [
  "ADM" => ["movimientos.php", "productos.php", "usuarios.view.php", "categorias.php", "marcas.php", "personas.php", "reportes.php"],
  "SPV" => ["movimientos.php", "usuarios.view.php", "productos.php", "reportes.php"],
  "AST" => ["movimientos.php", "productos.php", "reportes.php"]
];

//4. Validar el acceso
$autorizado = false;

//5. Comprobar los permisos
$vistasPermitidas = $permisos[$nivelacceso];

foreach($vistasPermitidas as $item){
  if ($item == $vistaActiva){
    $autorizado = true;
  }
}

if (!$autorizado){
  //Cargar una vista
  echo "<h1>Acceso restringido</h1>";
  exit();
}

?>