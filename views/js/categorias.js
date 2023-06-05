document.addEventListener("DOMContentLoaded", () => {

    const cuerpoTablaCate = document.querySelector("#BodyCate");

    function listarCategorias(){
        const parametros = new URLSearchParams();
        parametros.append("operacion", "listarCategorias");
  
        fetch("../controllers/categorias.controller.php", {
          method: 'POST',
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos =>{
          cuerpoTablaCate.innerHTML = ``;
          datos.forEach(element => {
            const fila = `
            <tr>
              <td>${element.idcategoria}</td>  
              <td>${element.categoria}</td>  
            </tr>
            `;
            cuerpoTablaCate.innerHTML += fila;
          })
        })
      }

      listarCategorias();
})