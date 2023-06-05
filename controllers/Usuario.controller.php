<?php
//Iniciamos/heredamos la sesión
session_start();

//La sesión contendrá datos del login en formato de arreglo
$_SESSION["login"] = [];

require_once '../models/Usuario.php';

if (isset($_POST['operacion'])){

  $usuario = new Usuario();

  if ($_POST['operacion'] == 'login'){
    //Buscamos al usuario a través de su nombre
    $datoObtenido = $usuario->login($_POST['usuario']);
    //Arreglo que contiene datos de login
    $resultado = [
      "status"        => false,
      "apellidos"     => "",
      "nombres"       => "",
      "nivelacceso"   => "",
      "mensaje"       => ""
    ];
    
    if ($datoObtenido){
      //Encontramos el registro
      $claveEncriptada = $datoObtenido['claveacceso'];
      if (password_verify($_POST['claveIngresada'], $claveEncriptada)){
        //Clave correcta
        $resultado["status"] = true;
        $resultado["apellidos"] = $datoObtenido["apellidos"];
        $resultado["nombres"] = $datoObtenido["nombres"];
        $resultado["nivelacceso"] = $datoObtenido["nivelacceso"];
      }else{
        //Clave incorrecta
        $resultado["mensaje"] = "Contraseña incorrecta";
      }
    }else{
      //Usuario no encontrado
      $resultado["mensaje"] = "No se encuentra el usuario";
    }

    //Actualizando la información en la variable de sesión
    $_SESSION["login"] = $resultado;
    
    //Enviando información de la sesión a la vista
    echo json_encode($resultado);
  }

}

if (isset($_GET['operacion']) == 'destroy'){
  session_destroy();
  session_unset();
  header("location:../login.php");
}

?>