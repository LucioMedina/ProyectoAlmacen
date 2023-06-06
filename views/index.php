<?php
session_start();
if (!isset($_SESSION['login']) || !$_SESSION['login']['status']){
    header("Location:../");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos</title>

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
  <h1 class="fw-bold text-white">BIENVENIDO AL ALMACEN <?= $_SESSION['login']['nombres'] ?></h1>

</div>

<div class="container2 mt-3">
    <div class="row">

      <div class="col-md-7 ">
        <canvas id="grafico"></canvas>

      </div>
      <div class="col-md-5 mt-5">
 
       <ul id="lista-leyenda">

       </ul>   

       <button class="btn btn-sm btn-success" id="actualizar">Actualizar</button>
        </div>


      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", () =>{


      const btActualizar = document.querySelector("#actualizar");
      const lienzo = document.getElementById("grafico");
      const leyenda = document.querySelector("#lista-leyenda");

      const graficoBarras = new Chart(lienzo, {
        type: "bar",
        data: {
          labels: [ ],
          datasets:[
            {
              label: '',
              data:[],
              
            }
          ]
        }
      });

      function renderGraphic(coleccion = []){
        let etiquetas = [];
        let datos = [];
        leyenda.innerHTML = ``;

        coleccion.forEach(element =>{
          etiquetas.push(element.idproducto);
                    datos.push(element.Productos);

                    const  tagLI = document.createElement('li');
                    tagLI.innerHTML = `${element.idproducto}: <strong>${element.Productos}</strong`;
                    leyenda.appendChild(tagLI);
        });
        graficoBarras.data.labels = etiquetas;
        graficoBarras.data.datasets[0].data = datos;
        graficoBarras.update();
      }

      function loadData(){
        const parametros = new URLSearchParams();
        parametros.append('operacion', 'resumenProductos');

        fetch(`../controllers/productos.controller.php`,{
          method: 'POST',
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos => {
          renderGraphic(datos);
        });
      }
      btActualizar.addEventListener('click',loadData);


    });
  </script>
<style>
  .container {
    
    width: 600px;
    height: 200px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 5);
    border-radius: 20px;
    backdrop-filter: blur(20px);
    box-shadow: 0 0 30px rgba(0, 0, 0, .5);
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  }

  @media (max-width: 952px){
    .navbar{
      padding-left: 20px;
    }
  }

</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {

    //Forma 1
    //Crearemos una función que obtenga la URL(vista)
    function getURL(){
        //1. Obtener la URL
        const url = new URL(window.location.href);
        //2. Obtener el valor enviado por la URL
        const vista = url.searchParams.get("view");
        //3. Crear un objeto que referencia contenedor
        const contenedor = document.querySelector("#content-dinamics");
        
        //Cuando el usuario elige una opción...
        if (vista != null){
            fetch(vista)
                .then(respuesta => respuesta.text())
                .then(datos => {
                    contenedor.innerHTML = datos;

                    //Necesitamos recorrer todas las etiquetas <script> y "reactivarlas"
                    const scriptsTag = contenedor.getElementsByTagName("script");
                    for (i = 0; i < scriptsTag.length; i++){
                        eval(scriptsTag[i].innerText);
                    }
                });
        }
    }
    getURL();
});
</script>


</body>
</html>