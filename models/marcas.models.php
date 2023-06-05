<?php

require_once "conexion.php";

class Marca extends Conexion{

    private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listarMarcas(){
    try{
      $consulta = $this->conexion->prepare("CALL spu_listar_marcas()");
      $consulta->execute();
      $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

      return $datos;

    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function registrarMarcas($datosMarcas=[]){

    $respuesta=[
      "status" => false,
      "message" => ""
    ];

    try{
      $consulta = $this->conexion->prepare("CALL spu_registrar_marcas(?)");
      $respuesta["status"] = $consulta->execute(array(

        $datosMarcas['marca']
      ));

    }catch(Exception $e){
      $respuesta["message"] = "No se pudo completar el proceso de registro. Código de error: ".$e->getMessage();
    }
    return $respuesta;

  }

}