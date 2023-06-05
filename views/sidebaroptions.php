<?php

//1. Necesitamos saber qué NIVEL DE ACCESO tiene el usuario
//Revise controlador...
$permiso = $_SESSION['login']['nivelacceso'];

//2. Array con los permisos por cada NIVEL DE ACCESO
$opciones = [];

//ADM - SPV - AST
switch ($permiso){
  case "ADM":
    $opciones = [
      ["menu" => "Movimientos", "url" => "movimientos.php"],
      ["menu" => "Productos", "url" => "productos.php"],
      ["menu" => "Usuarios", "url" => "usuarios.view.php"],
      ["menu" => "Categorias", "url" => "categorias.php"],
      ["menu" => "Marcas", "url" => "marcas.php"],
      ["menu" => "Personas", "url" => "personas.php"],
      ["menu" => "Reportes", "url" => "reportes.php"]
    ];
  break;
  case "SPV":
    $opciones = [
      ["menu" => "Movimientos", "url" => "movimientos.php"],
      ["menu" => "Usuarios", "url" => "usuarios.view.php"],
      ["menu" => "Productos", "url" => "productos.php"],
      ["menu" => "Reportes", "url" => "reportes.php"]
    ];    
  break;
  case "AST":
    $opciones = [
      ["menu" => "Movimientos", "url" => "movimientos.php"],
      ["menu" => "Productos", "url" => "productos.php"],
      ["menu" => "Reportes", "url" => "reportes.php"]
    ];
  break;
}

//Renderizar los ítems del SIDEBAR
foreach($opciones as $item){
  echo "
    <li class='nav-item'>
      <a class='nav-link' href='{$item['url']}'>
          <i class='fas fa-fw fa-chart-area'></i>
          <span>{$item['menu']}</span></a>
    </li>
  ";
}