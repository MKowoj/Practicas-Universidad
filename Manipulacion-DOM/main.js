let boton = document.getElementById("boton");
let nombreEquipo = document.getElementById("nombre-equipo");
let nombreMarca = document.getElementById("nombre-marca");
let nombreModelo = document.getElementById("nombre-modelo");
let nombreStatus = document.getElementById("nombre-status");
let nombreComentario = document.getElementById("nombre-comentario");
let nombreCondiciones = document.getElementById("nombre-condiciones");
  
window.removeElement = function(event){
  // 1. event.target identifica el botón rojo exacto que acabas de presionar
  // 2. parentElement sube un nivel en la jerarquía para seleccionar toda la tarjeta amarilla (.Notification)
  // 3. remove() elimina ese contenedor completo del HTML
  event.target.parentElement.remove();
}

boton.onclick = function(){
  let equipo = document.getElementById("equipo");
  if(equipo.value === ""){
    nombreEquipo.style.color = "red";
  }else{
    nombreEquipo.style.color = "green";
  }

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

  let condicionesMarcadas = [];  
  let condiciones = document.querySelectorAll("input[type='checkbox']");
  let algunoMarcado = false;
  for(let elemento of condiciones){
    if(elemento.checked){
      algunoMarcado = true;
      condicionesMarcadas.push(elemento.nextElementSibling.innerHTML);
    }
  }

  if(algunoMarcado === true){
    nombreCondiciones.style.color = "green";
  }else{
    nombreCondiciones.style.color = "red";
  }

  const $form = document.getElementById("formularioEquipos")
  const $divElements = document.getElementById("divElements")
  const $boton = document.getElementById("boton")

  const templateElement = (data, estatus, condiciones, comentarios) => {
  return (`
      <button class="delete" onclick="removeElement(event)">X</button>
      <p><strong>Equipo registrado: </strong> ${data}</p>
      <p><strong>Estatus de registro: </strong> ${estatus}</p>
      <p><strong>Condiciones de registro: </strong> ${condiciones}</p>
      <p><strong>Comentario: </strong> ${comentarios}</p>`)
}

  if(equipo.value != "" &&  marca.value != ""){
    const $div = document.createElement("div")
    $div.classList.add("Notification")
    $div.innerHTML = templateElement(`${$form.equipo.value}, 
                                      ${$form.marca.value}, 
                                      ${$form.modelo.value}`, status.value, condicionesMarcadas, comentarios.value)
    $divElements.appendChild($div)
    $form.reset()
  }else{
    alert("Complete los campos")
  }
}


