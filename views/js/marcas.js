document.addEventListener("DOMContentLoaded", () => {

    const cuerpoTablaMarca = document.querySelector("#BodyMarca");

    function listarMarcas(){
        const parametros = new URLSearchParams();
        parametros.append("operacion", "listarMarcas");
  
        fetch("../controllers/marcas.controller.php", {
          method: 'POST',
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos =>{
          cuerpoTablaMarca.innerHTML = ``;
          datos.forEach(element => {
            const fila = `
            <tr>
              <td>${element.idmarca}</td>  
              <td>${element.marca}</td>  
            </tr>
            `;
            cuerpoTablaMarca.innerHTML += fila;
          })
        })
      }

      listarMarcas();
})