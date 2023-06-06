document.addEventListener("DOMContentLoaded", () => {

  const btGuardar = document.querySelector("#btGuardar");
  const cuerpoTabla = document.querySelector("tbody");
  const inputUsuario  = document.querySelector("#usuario");

    function listarMovimientos(){
        const parametros = new URLSearchParams();
        parametros.append("operacion", "listarMovimientos");
  
        fetch("../controllers/movimientos.controller.php", {
          method: 'POST',
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos =>{
          cuerpoTabla.innerHTML = ``;
          datos.forEach(element => {
            const fila = `
            <tr>
              <td>${element.idmovimiento}</td>  
              <td>${element.tipo}</td>
              <td>${element.descripcion}</td>
              <td>${element.idproducto}</td> 
              <td>${element.fecha}</td>
              <td> <?= $_SESSION['login']['nombres'] ?> </td>
              <td>${element.stock}</td>
              <td>${element.cantidad}</td>
            </tr>
            `;
            cuerpoTabla.innerHTML += fila;
          })
        })
      }

      function registrarMovimientos(){
        if(confirm("¿Estás seguro de grabar?")){
            const parametros = new URLSearchParams();
            parametros.append("operacion", "registrarMovimientos");
            parametros.append("idproducto", document.querySelector("#idProducto").value);
            parametros.append("idusuario", document.querySelector("#nombresesion").value);
            parametros.append("tipo", document.querySelector("#tipo").value);
            parametros.append("descripcion", document.querySelector("#descripcion").value);
            parametros.append("cantidad", document.querySelector("#cantidad").value);
    
            fetch("../controllers/movimientos.controller.php",{
            method: 'POST',
            body: parametros
            })
            .then(response => response.json())
            .then(datos => {
            if(datos.status){
                document.querySelector("#form-movimientos").reset();
                listarMovimientos();
            }else{
                alert(datos.message);
            }
            });
        }
      }

      function mandarNombreUsuario() {
        const parametros = new URLSearchParams();
        parametros.append("operacion", "login");
        parametros.append("idusuario", idusuario);
    
        fetch("../controllers/Usuario.controller.php", {
          method: 'POST',
          body: parametros
        })
        .then(response => response.json())
        .then(datos => {
          inputUsuario.value = datos.nombres;
        });
      }
        
    
        btGuardar.addEventListener("click", registrarMovimientos)

      
      listarMovimientos();
      mandarNombreUsuario();
})