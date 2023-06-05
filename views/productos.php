<?php require_once 'permisos.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>

<!-- BS5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<link href="./css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
  
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
            <li class="nav-link active" aria-current="page">
            <?php require_once './sidebaroptions.php'; ?>
            </li>
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
<hr>
<hr>
<hr>
  <div class="container">
      <h1 class="fw-bold text-white">Productos del Almacen</h1>
      <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-categoria">Ver Categorias</button>
      <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-marcas">Ver Marcas</button>

    <div class="container">
      <div class="row mt-8">
        <!--Formulario-->
        <div class="formProductos col-md-4">
          <form action="" autocomplete="off" id="form-productos">
            <div class="card">
              <div class="text fw-bold text-white">
                Registro de productos
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="idcategoria" class="form-label">ID Categoria</label>
                  <input type="number" class="form-control form-control-sm" id="idCategoria">
                </div>
                <div class="mb-3">
                  <label for="idmarca" class="form-label">ID Marca</label>
                  <input type="number" class="form-control form-control-sm" id="idMarca">
                </div>
                <div class="mb-3">
                  <label for="descripcion" class="form-label">Descripcion</label>
                  <input type="text" class="form-control form-control-sm" id="descripcion">
                </div>
                <div class="mb-3">
                  <label for="modelo" class="form-label">Modelo</label>
                  <input type="text" class="form-control form-control-sm" id="modelo">
                </div>
                <div class="mb-3">
                  <label for="precio" class="form-label">Precio</label>
                  <input type="number" class="form-control form-control-sm" id="precio">
                </div>
                <div class="mb-3">
                  <label for="stock" class="form-label">Stock</label>
                  <input type="number" class="form-control form-control-sm" id="stock">
                </div>
                <div class="">
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

<style>

</style>

        <div class="col-md-8">
          <table id="tablaProductos" class="table table-striped">
            <thead class="bg-primary text-white">
              <tr>
                <th>ID Producto</th>
                <th>Categoria</th>
                <th>Descripción</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>precio</th>
                <th>Stock</th>
                <th>Comandos</th>
              </tr>
            </thead>
            <tbody class="bg-body">
      
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

 

    <!-- Zona de MODALES -->
  <div class="modal fade" tabindex="-1" id="modal-buscador" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buscador de productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formulario-busqueda">
                    <label for="idbuscado" class="form-label">Escriba ID:</label>
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" id="idbuscado">
                        <button type="button" class="btn btn-primary" id="boton-buscar">Buscar</button>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Categoria:</label>
                        <input type="text" class="form-control" id="nombreproducto" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Descripcion:</label>
                        <input type="text" class="form-control" id="nombreproducto" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Modelo:</label>
                        <input type="text" class="form-control" id="descripcion" readonly>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <div class="col">
                        <label for="precio" class="form-label">Marca:</label>
                        <input type="text" class="form-control" id="precio" readonly>
                        </div>
                        <div class="col">
                        <label for="stock" class="form-label">Precio:</label>
                        <input type="text" class="form-control" id="stock" readonly>
                        </div>
                        <div class="col">
                        <label for="stock" class="form-label">Stock:</label>
                        <input type="text" class="form-control" id="stock" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    </div>
    <!-- Fin zona de modales -->

    <!-- Zona de MODALES CATEGORIA -->
    <div class="modal fade" tabindex="-1" id="modal-categoria" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Categorias</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formulario-categorias">
                    <table id="tablaCategorias" class="table table-striped">
                        <thead class="bg-info">
                        <tr>
                            <th>ID Categoria</th>
                            <th>Nombre</th>
                        </tr>
                        </thead>
                        <tbody id="BodyCate">
                
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    </div>
    <!-- Fin zona de MODALES CATEGORIA -->

    <!-- Zona de MODALES MARCAS -->
    <div class="modal fade" tabindex="-1" id="modal-marcas" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Marcas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formulario-marcas">
                    <table id="tablaMarcas" class="table table-striped">
                        <thead class="bg-info">
                        <tr>
                            <th>ID Marca</th>
                            <th>Nombre</th>
                        </tr>
                        </thead>
                        <tbody id="BodyMarca">
                
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    </div>
    <!-- Fin zona de MODALES MARCAS -->

    <!-- Zona de MODALES ACTUALIZAR -->
<div class="modal fade" tabindex="-1" id="modal-productos" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Actualizar Producto</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="" id="formulario-busqueda">
                  <div class="mb-3">
                      <label for="descripcion" class="form-label">Descripcion:</label>
                      <input type="text" class="form-control" id="md-descripcion">
                  </div>
                  <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo:</label>
                    <input type="text" class="form-control" id="md-modelo">
                </div>
                  <div class="mb-3">
                      <label for="precio" class="form-label">Precio:</label>
                      <input type="number" class="form-control" id="md-precio">
                  </div>
                  <div class="mb-3 d-flex align-items-center">
                    <div class="col">
                      <label for="stock" class="form-label">Stock:</label>
                      <input type="number" class="form-control" id="md-stock">
                    </div>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" id="actualizar">Guardar</button>
          </div>
      </div>
  </div>
</div>
<!-- Fin zona de modales ACTUALIZAR-->

    <style>
      body {
        background: url('./img/arbol.jpg') no-repeat;
        background-size: cover;
        background-position: center;
        flex-wrap: wrap;
      }

      .container{
      width: 100%;
      height: 50px;
      margin: 30px;
    }
    </style>

    <script src="./js/marcas.js"></script>
    <script src="./js/categorias.js"></script>
    <script src="./js/productos.js"></script>
 
    

</body>
</html>