<?php

require_once '../models/marcas.models.php';

if (isset($_POST['operacion'])){

  $Marca = new Marca();

  if ($_POST['operacion'] == 'listarMarcas'){

    $datos = $Marca->listarMarcas();

    echo json_encode($datos);

  }

  if($_POST['operacion'] == 'registrarMarcas'){
    $datosSolicitados=[
        "marca"   =>$_POST['marca']
    ];
    $respuesta = $Marca->registrarMarca($datosSolicitados);
    echo json_encode($respuesta);
  }
}