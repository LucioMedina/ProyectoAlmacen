src="https://cdn.jsdelivr.net/npm/sweetalert2@11"

document.addEventListener("DOMContentLoaded", () =>{
    const btGuardar = document.querySelector("#btGuardar");
    const btActualizar = document.querySelector("#actualizar");
    const btBuscar = document.querySelector("#boton-buscar");
    const tabla = document.querySelector("#tablaProductos");
    const cuerpoTabla = document.querySelector("tbody");
    const CateTabla = document.querySelector("#tablaCategorias");
    const modal = new bootstrap.Modal(document.querySelector("#modal-productos"));

    function listarProductos(){
    const parametros = new URLSearchParams();
    parametros.append("operacion", "listarProductos");

    fetch("../controllers/productos.controller.php", {
    method: 'POST',
    body: parametros
    })
        .then(respuesta => respuesta.json())
        .then(datos =>{
        cuerpoTabla.innerHTML = ``;
        let numeroFila = 1;
        datos.forEach(element => {
            const fila = `
        <tr>
            <td>${element.idproducto}</td>
            <td>${element.categoria}</td>  
            <td>${element.descripcion}</td>  
            <td>${element.modelo}</td>  
            <td>${element.marca}</td>
            <td>${element.precio}</td>
            <td>${element.stock}</td>
            <td>
               <a href='#' class='editar' data-idproducto='${element.idproducto}'>Editar</a>
               <a href='#' class='eliminar' data-idproducto='${element.idproducto}'>Eliminar</a>
            </td>
        </tr>
            `;
            cuerpoTabla.innerHTML += fila;
            numeroFila++;
        })
        })
    }

    function registrarProductos(){
    if(confirm("¿Estás seguro de grabar?")){
        const parametros = new URLSearchParams();
        parametros.append("operacion", "registrarProductos");
        parametros.append("idcategoria", document.querySelector("#idCategoria").value);
        parametros.append("idmarca", document.querySelector("#idMarca").value);
        parametros.append("descripcion", document.querySelector("#descripcion").value);
        parametros.append("modelo", document.querySelector("#modelo").value);
        parametros.append("precio", document.querySelector("#precio").value);
        parametros.append("stock", document.querySelector("#stock").value);

        fetch("../controllers/productos.controller.php",{
        method: 'POST',
        body: parametros
        })
        .then(response => response.json())
        .then(datos => {
        if(datos.status){
            document.querySelector("#form-productos").reset();
            listarProductos();
        }else{
            alert(datos.message);
        }
        });
    }
    }

    function buscarProductos(){
    const parametros = new URLSearchParams();
    parametros.append("operacion", "obtenerProductos");

    fetch("../controllers/productos.controller.php", {
    method: 'POST',
    body: parametros
    })
        .then(respuesta => respuesta.json())
        .then(datos =>{
        cuerpoTabla.innerHTML = ``;
        datos.forEach(element => {
            const fila = `
            <tr>
            <td>${element.idproducto}</td>
            <td>${element.categoria}</td>  
            <td>${element.descripcion}</td>  
            <td>${element.modelo}</td>  
            <td>${element.marca}</td>
            <td>${element.precio}</td>
            <td>${element.stock}</td>
            </tr>
            `;
            cuerpoTabla.innerHTML += fila;

        document.getElementById('categoria').value = element.categoria;
        document.getElementById('descripcion').value = element.descripcion;
        document.getElementById('modelo').value = element.modelo;
        document.getElementById('marca').value = element.marca;
        document.getElementById('precio').value = element.precio;
        document.getElementById('stock').value = element.stock;

        })
        })
    }

    //Proceso eliminación
   cuerpoTabla.addEventListener("click", (event) =>{
    if (event.target.classList[0] === 'eliminar'){
        if (confirm("¿Está seguro de eliminar?")){
            idproducto = parseInt(event.target.dataset.idproducto);

            const parametros = new URLSearchParams();
            parametros.append("operacion", "eliminarProductos");
            parametros.append("idproducto", idproducto);

            fetch("../controllers/productos.controller.php", {
                method: 'POST',
                body: parametros
            })
            .then(respuesta => respuesta.json())
            .then(datos => {
                if(datos.status){
                    alert("Eliminado correctamente");
                    listarProductos();
                }else{
                    alert(datos.message);
                }
            });
        }
    }
   })

   function actualizarProductos(){
    if(confirm("¿Está seguro de actualizar?")){
        const parametros = new URLSearchParams();
        parametros.append("operacion", "actualizarProductos");

        parametros.append("idproducto", idproducto);
        parametros.append("descripcion", document.querySelector("#md-descripcion").value);
        parametros.append("modelo", document.querySelector("#md-modelo").value);
        parametros.append("precio", document.querySelector("#md-precio").value);
        parametros.append("stock", document.querySelector("#md-stock").value);

        fetch("../controllers/productos.controller.php", {
            method: 'POST',
            body: parametros
        })
        .then(response => response.json())
        .then(datos =>{
            if(datos.status){
                alert("Actualizado Correctamente");
                modal.toggle();
                listarProductos();
            }else{
                alert(datos.message);
            }
        })
    }
   }

   //Proceso actualizar
   cuerpoTabla.addEventListener("click", (event) => {
    if(event.target.classList[0] === 'editar'){
        idproducto = parseInt(event.target.dataset.idproducto);

        const parametros = new URLSearchParams();
        parametros.append("operacion", "obtenerProductos");
        parametros.append("idproducto", idproducto);

        fetch("../controllers/productos.controller.php", {
            method: 'POST',
            body: parametros
        })
        .then(response => response.json())
        .then(datos =>{
          document.querySelector("#md-descripcion").value = datos.descripcion;
          document.querySelector("#md-modelo").value = datos.modelo;
          document.querySelector("#md-precio").value = datos.precio;
          document.querySelector("#md-stock").value = datos.stock;

          modal.toggle();
        })
    }
   })

    btActualizar.addEventListener("click", actualizarProductos);
    btBuscar.addEventListener("click", buscarProductos);
    btGuardar.addEventListener("click", registrarProductos);
    listarProductos();
    
})