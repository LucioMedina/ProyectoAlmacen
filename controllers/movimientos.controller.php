<?php

require_once '../models/movimientos.models.php';

if (isset($_POST['operacion'])){

  $Movimiento = new Movimiento();

  if ($_POST['operacion'] == 'listarMovimientos'){

    $datos = $Movimiento->listarMovimientos();

    echo json_encode($datos);

  }

  if($_POST['operacion'] == 'registrarMovimientos'){
    $datosSolicitados=[
        "idproducto"   =>$_POST['idproducto'],
        "idusuario"    =>$_POST['idusuario'],
        "tipo"         =>$_POST['tipo'],
        "descripcion"  =>$_POST['descripcion'],
        "cantidad"     =>$_POST['cantidad']
    ];
    $respuesta = $Movimiento->registrarMovimientos($datosSolicitados);
    echo json_encode($respuesta);
  }
}