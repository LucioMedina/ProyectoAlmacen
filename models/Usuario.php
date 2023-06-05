<?php

require_once 'conexion.php';

class Usuario extends Conexion{

  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function login($nombreUsuario = ''){
    try{
      $consulta = $this->conexion->prepare("CALL spu_buscar_usuarios(?)");
      $consulta->execute(array($nombreUsuario));

      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

}