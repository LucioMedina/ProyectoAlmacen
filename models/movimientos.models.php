<?php

require_once "conexion.php";

class Movimiento extends Conexion{
  
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listarMovimientos(){
    try{
      $consulta = $this->conexion->prepare("CALL spu_listar_movimientos()");
      $consulta->execute();
      $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

      return $datos;

    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function registrarMovimientos($datosMovimientos=[]){

    $respuesta=[
      "status" => false,
      "message" => ""
    ];

    try{
      $consulta = $this->conexion->prepare("CALL spu_registrar_movimientos(?,?,?,?,?)");
      $respuesta["status"] = $consulta->execute(array(

        $datosMovimientos['idproducto'],
        $datosMovimientos['idusuario'],
        $datosMovimientos['tipo'],
        $datosMovimientos['descripcion'],
        $datosMovimientos['cantidad']
      ));

    }catch(Exception $e){
      $respuesta["message"] = "No se pudo completar el proceso de registro. Código de error: ".$e->getMessage();
    }
    return $respuesta;

  }
}