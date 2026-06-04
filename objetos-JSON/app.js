// 1. OBTENER REFERENCIAS A LOS ELEMENTOS DEL HTML
const formCrear = document.getElementById('form-crear');
const spanResultadoJSON = document.getElementById('resultado-json');

const formRecibir = document.getElementById('form-recibir');
const inputJSON = document.getElementById('input-json');
const cuerpoTabla = document.getElementById('cuerpo-tabla');

// 2. ESCUCHAR EL EVENTO 'SUBMIT' DEL PRIMER FORMULARIO
formCrear.addEventListener('submit', function(evento) {
    // a) Prevenir que la página se recargue al enviar el formulario
    evento.preventDefault(); 

    // b) Extraer los valores que el usuario escribió en los inputs
    const valorSku = document.getElementById('sku').value;
    const valorNombre = document.getElementById('nombre').value;
    const valorCantidad = document.getElementById('cantidad').value;
    const valorPrecio = document.getElementById('precio').value;

    // c) Crear el Objeto de JavaScript
    const productoObjeto = {
        sku: valorSku,
        nombre: valorNombre,
        // Convertimos a número usando parseFloat o parseInt para que el tipo de dato sea correcto
        cantidad: parseInt(valorCantidad), 
        precio: parseFloat(valorPrecio)
    };

    // d) Convertir el Objeto JavaScript a notación JSON 
    const productoJSON = JSON.stringify(productoObjeto);

    // e) Mostrar el resultado en el HTML
    spanResultadoJSON.textContent = productoJSON;
});

// 3. ESCUCHAR EL EVENTO 'SUBMIT' DEL SEGUNDO FORMULARIO
formRecibir.addEventListener('submit', function(evento) {
    evento.preventDefault();

    // a) Obtener el texto JSON que pegó el usuario en el textarea
    const cadenaJSON = inputJSON.value;

    // b) Convertir la cadena JSON de vuelta a un Objeto JavaScript
    const productoRecibido = JSON.parse(cadenaJSON);

    // c) Crear una nueva fila para la tabla (<tr>)
    const nuevaFila = document.createElement('tr');

    // d) Insertar el código HTML dentro de la nueva fila usando los datos del objeto
    nuevaFila.innerHTML = `
        <td>${productoRecibido.sku}</td>
        <td>${productoRecibido.nombre}</td>
        <td>${productoRecibido.cantidad}</td>
        <td>$${productoRecibido.precio}</td>
    `;

    // e) Agregar la nueva fila al cuerpo de la tabla
    cuerpoTabla.appendChild(nuevaFila);

    // f) Limpiar el textarea para el siguiente uso
    inputJSON.value = '';
});