<?php require_once 'permisos.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movimientos</title>

<!-- BS5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<link href="./css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
  
<style>
    body {
        background: url('./img/arbol.jpg') no-repeat;
        background-size: cover;
        background-position: center;
    }

    .container{
      width: 100%;
      height: 50px;
      margin: 70px;
    }
</style>

<header>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="">Almacen</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class=" navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <!-- OPCIONES QUE DEBEN SER FILTRADAS DE ACUERD AL PERFIL -->
            <?php require_once './sidebaroptions.php'; ?>
            <!-- FIN OPCIONES DEL SIDEBAR -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600">
                    <?= $_SESSION['login']['nombres'] ?>
                </span>
              </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Perfil</a></li>
                <li><a class="dropdown-item" href="#">Configuración</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../controllers/Usuario.controller.php?operacion=destroy">Cerrar sesión</a></li>
              </ul>
            </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<div class="container">
    <h1 class="fw-bold text-white">Movimientos en el almacen</h1>
    <div class="container">
      <div class="row mt-3">
        <!--Formulario-->
        <div class="col-md-4">
          <form action="" autocomplete="off" id="form-movimientos">
            <div class="card">
              <div class="card-header">
                Registro de movimientos
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="idproducto" class="form-label">ID Producto</label>
                  <input type="number" class="form-control form-control-sm" id="idProducto">
                </div>
                <div class="mb-3">
                  <label for="tipo" class="form-label">Tipo</label>
                  <select name="tipo" id="tipo" class="form-select">
                      <option value="">Seleccione</option>
                      <option value="SALIDA">SALIDA</option>
                      <option value="ENTRADA">ENTRADA</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="descripcion" class="form-label">Descripcion</label>
                  <input type="text" class="form-control form-control-sm" id="descripcion">
                </div>
                <div class="mb-3">
                  <label for="cantidad" class="form-label">Cantidad</label>
                  <input type="number" class="form-control form-control-sm" id="cantidad">
                </div>
                <div class="mb-3">
                  <label for="cantidad" class="form-label">Usuario</label>
                  <span class="mr-2 d-none d-lg-inline text-gray-600" id="nombresesion">
                  <?= $_SESSION['login']['nombres'] ?>
                </span>
                </div>
                <div class="card-footer text-muted">
                  <div class="d-grid gap-2">
                    <button class="btn btn-sm btn-success" id="btGuardar" type="button">Guardar</button>
                    <button class="btn btn-sm btn-secondary" type="reset">Reiniciar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      <!--Fin Formulario-->
        <div class="col-md-8">
          <table id="tablaProductos" class="table table-striped">
            <thead class="bg-primary text-white">
              <tr>
                <th>ID Movimiento</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>idproducto</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Stock Actualizado</th>
                <th>Cantidad</th>
              </tr>
            </thead>
            <tbody class="bg-body">
      
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>


  <script src="./js/movimientos.js"></script>

</body>
</html>