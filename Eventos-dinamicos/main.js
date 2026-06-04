  //Obtenemos los elementos del HTML por sus ID usando getElementByID. Y asignamos una variable que nos permitirá modificar su color.
  let botonRegistrar = document.getElementById("boton");
  let nombreEquipo = document.getElementById("nombre-equipo");
  let nombreMarca = document.getElementById("nombre-marca");
  let nombreModelo = document.getElementById("nombre-modelo");
  let nombreStatus = document.getElementById("nombre-status");
  let nombreComentario = document.getElementById("nombre-comentario");
  let nombreCondiciones = document.getElementById("nombre-condiciones");
  let botonBorrarTodo = document.getElementById("botonVaciar");
  let contenedorRegistros = document.getElementById("divElements");
    
  botonBorrarTodo.addEventListener("click", function() {
    contenedorRegistros.innerHTML=""; //vaciamos todo
    botonBorrarTodo.style.display = "none"; //ocultamos el botón
    alert("Todos los registros eliminados");
  });


  //Al hacer click en el botón REGISTRAR se ejecuta la siguiente función.
  botonRegistrar.onclick = function(){
    //Obteneemos el nombre del equipo.
    let equipo = document.getElementById("equipo");
    //si el valor de equipo se deja vacío entonces su estilo se vuelve color rojo.
    if(equipo.value === ""){
      nombreEquipo.style.color = "red";
    }else{
      nombreEquipo.style.color = "green"; //cuando se tiene éxito entonces se pone verde.
    }

    //La lógica es igual para los siguientes valores.
    let marca = document.getElementById("marca");
    if(marca.value === ""){
      nombreMarca.style.color = "red";
    }else{
      nombreMarca.style.color = "green";
    }

    let modelo = document.getElementById("modelo");
    if(modelo.value === ""){
      nombreModelo.style.color = "red";
    }else{
      nombreModelo.style.color = "green";
    }

    let status = document.getElementById("status");
    if(status.value === ""){
      nombreStatus.style.color = "red";
    }else{
      nombreStatus.style.color = "green";
    }

    let comentario = document.getElementById("comentarios");
    if(comentario.value === ""){
      nombreComentario.style.color = "red";
    }else{
      nombreComentario.style.color = "green";
    }

    // TERMINA EL FLUJO DE CAMBIO DE COLORES. 
    //INICIA LÓGICA PARA CREAR EL CATÁLOGO

    //Creamos un array vacío para almaenar las opciones marcadas de las condiciones.
    let condicionesMarcadas = [];  
    let condiciones = document.querySelectorAll("input[type='checkbox']"); //Usamos querySelectorAll como método para obtener esos datos QUE CON INPUT de tipo checkbox
    //Iniciamos la variable como falsa.
    let algunoMarcado = false;
    //Corremos el ciclo donde el listado completo son las condiciones y uno individual es el elemento.
    for(let elemento of condiciones){
      //si un elemento ha sido marcado
      if(elemento.checked){
        //cambiamos el valor de la variable a TRUE.
        algunoMarcado = true;
        //Extraemos el texto de la etiqueta (label) hermana del checkbox y lo insertamos en el arreglo condicionesMarcadas.
        condicionesMarcadas.push(elemento.nextElementSibling.innerHTML);
      }
    }

    //Si alguno fue marcado en el checkbox se coloca en verde el estilo del nombre de la caja. Si no, en rojo.
    if(algunoMarcado === true){
      nombreCondiciones.style.color = "green";
    }else{
      nombreCondiciones.style.color = "red";
    }

    //obtenemos el formulario por su ID de los equipos.
    const $form = document.getElementById("formularioEquipos");
    //Obtenemos la tarjeta llamada divElements donde se guardarán los datos de los equipos registrados.
    const $divElements = document.getElementById("divElements");
    
    //Creamos la función plantilla que nos devuelve la estructura de HTML en texto con los datos del registro
    const cajaRegistro = (data, estatus, condiciones, comentarios) => {
      return (`
          <p><strong>EQUIPO REGISTRADO</strong>
          <p><strong>Nombre: </strong> ${data}</p>
          <p><strong>Estatus: </strong> ${estatus}</p>
          <p><strong>Condiciones: </strong><br> ${condiciones}</p>
          <p><strong>Comentario: </strong> ${comentarios}</p>`)
    }

    //Siempre que no haya un campo vacío se ejecutará la creación de la caja.
    if(equipo.value != "" &&  marca.value != ""){
      //Creamos un div
      const $div = document.createElement("div");
      //asignamos una clase llamada Notification
      $div.classList.add("Notification");
      //Ejecutamos la función plantilla pasándole los datos del formulario Y EL html resultante lo inyectamos dentro del nuevo $div
      $div.innerHTML = cajaRegistro(`${$form.equipo.value}, 
                                        ${$form.marca.value}, 
                                        ${$form.modelo.value}`, status.value, condicionesMarcadas.join("<br>"), comentarios.value
                                    );
      //Creamos el bottón borrar
      const $botonBorrar = document.createElement("button");
      //le agregamos la clase delete para agregarle estilo CSS.
      $botonBorrar.classList.add("delete");
      //Agregamos el texto eliminar
      $botonBorrar.textContent = "Eliminar";
      //Agregamos el evento que al hacer clic se procede a eliminar el elemento padre
      $botonBorrar.addEventListener("click",function(event){
        event.target.parentElement.remove();
      })
      $div.appendChild($botonBorrar); //AGREGAMOS el botón al div de la cajaRegistro 
      $divElements.appendChild($div); //el div lo agregamos a divElements, parte del HTML donde se insertará la cajaRegistro.
      
      //Reiniciamos el formulario vacío para volver llenar datos.
      $form.reset();

    }else{
      alert("Complete los campos");
    }

    botonBorrarTodo.style.display = "block"; //creamos el botón

  }


