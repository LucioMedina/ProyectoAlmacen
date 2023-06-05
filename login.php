<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- BS5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>

<style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: url('views/img/arbol.jpg') no-repeat;
      background-size: cover;
      background-position: center;
    }

    .container{
      position: relative;
      width: 400px;
      height: 440px;
      background: transparent;
      border-radius: 20px;
      backdrop-filter: blur(20px);
      box-shadow: 0 0 30px rgba(0, 0, 0, .8);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-floating{
      position: relative;
      width: 100%;
      height: 50px;
      border-bottom: 2px solid #162938;
      margin: 30px 0;
    }

    .container .form-box{
      width: 100%;
    padding: 40px;
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
        </ul>
      </div>
    </div>
  </nav>
</header>

<div class="container">
  <form action="" autocomplete="off" class="form-box">
          <h3 class="fw-bold text-white">Inicio de sesión</h3>
            <div class="form-floating">
              <input type="text" class="form-control" id="nombreusuario" placeholder="Nombre de usuario" autofocus>
              <label for="nombreusuario" class="form-label">Nombre de usuario</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="claveacceso" placeholder="Contraseña">
              <label for="claveacceso" class="form-label">Contraseña</label>
            </div>
          <div class="d-grid gap-2">
            <button class="btn btn-success" type="button" id="iniciar">Iniciar sesión</button>
            <button class="btn btn-secondary" type="button" id="olvide">Olvidé mi contraseña</button>
          </div>
        </form>    
</div>


  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const botonIniciarSesion = document.querySelector("#iniciar");
      const textPassword = document.querySelector("#claveacceso");

      function validarDatos(){
        const usuario = document.querySelector("#nombreusuario");
        const claveacceso = document.querySelector("#claveacceso");

        const parametros = new URLSearchParams();
        parametros.append("operacion", "login")
        parametros.append("usuario", usuario.value)
        parametros.append("claveIngresada", claveacceso.value)

        fetch(`./controllers/Usuario.controller.php`, {
          method: 'POST',
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datos => {
            if (!datos.status){
              alert(datos.mensaje);
              usuario.focus();
            }else{
              window.location.href = './views/';
            }
          })
          .catch(error => {
            console.log(error);
          });
      }

      textPassword.addEventListener("keypress", (evt) => {
        if (evt.charCode == 13) validarDatos();
      });

      botonIniciarSesion.addEventListener("click", validarDatos);
    });
  </script>

</body>
</html>
