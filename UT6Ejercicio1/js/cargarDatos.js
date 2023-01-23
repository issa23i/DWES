// CONSTANTES
const d = document



// LISTENERS
window.addEventListener('load', () => {
    cargarProductos()
})



// FUNCIONES
const cargarProductos = () => {
    let xhr = new XMLHttpRequest()
    
    xhr.addEventListener('readystatechange', e => {
        // continuar hasta que readyState sea 4
        if(xhr.readyState !== 4) return
        // si código éxito 200 - 299
        if(xhr.status >= 200 && xhr.status < 300){
            let productos = JSON.parse(xhr.responseText)
            crearTablaProductos(productos)
        } else {
            let message = xhr.statusText || "Ocurrió un error"
            error(message) // hacer algo con el error
        }
    })
    xhr.open('GET','../controlador/productos_json.php')
    xhr.send()
}

const crearTablaProductos = ( productos ) => {
    // contenedor listado productos 
    let $div = d.getElementById('productos')
    
    // crear tabla
    let $table = d.createElement('table')
    $div.appendChild($table)
    
    // crear cabecera de la tabla
    let $thead = d.createElement('thead')
    $table.appendChild($thead)
    
    let $tr = d.createElement('tr')
    $thead.appendChild($tr)
    
    let $thAdd = d.createElement('th')
    $thAdd.textContent = 'Añadir'
    $tr.insertAdjacentElement('beforeend',$thAdd)
    
    let $thCodigo = d.createElement('th')
    $thCodigo.textContent = 'Código'
    $tr.insertAdjacentElement('beforeend',$thCodigo)
    
    let $thNombre = d.createElement('th')
    $thNombre.textContent = 'Nombre'
    $tr.insertAdjacentElement('beforeend',$thNombre)
    
    let $thPVP = d.createElement('th')
    $thPVP.textContent = 'PVP'
    $tr.insertAdjacentElement('beforeend',$thPVP)
    
    let $thDetalle = d.createElement('th')
    $thDetalle.textContent = 'Detalle'
    $tr.insertAdjacentElement('beforeend',$thDetalle)
    
    //por cada fila 
    crearFila()
    //añadir la fila a la tabla
}

const crearFila = () => {
    // crear una fila de producto 
    
    //crear formulario en cada fila
    crearFormulario(textoBoton, codProducto, funcion) // la funcion añadir producto
    
    // retorna un tr
}

const error = (message) => {
    // qué hacer en caso de error
}

