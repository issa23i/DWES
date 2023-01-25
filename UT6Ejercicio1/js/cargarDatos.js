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
    // array asociativo  { cod => { 'producto': {producto}, 'unidades': unidades } } 
    if(productos.length > 0) {
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

        let $tbody = d.createElement('tbody')
        $thead.insertAdjacentElement('afterend')
        
        productos.forEach(producto => {
            let $fila = crearFila(producto)
            $tbody.insertAdjacentElement('beforeend', $fila)
        });
    }
}

const crearFila = (producto) => {
    
    // crear una fila de producto 
    let $fila = d.createElement('tr')
    
    let $td = d.createElement('td')
    $fila.appendChild($td)
        
    //crear formulario en cada fila
    //crearFormulario(textoBoton, codProducto, funcion) // la funcion añadir producto
    let codigoProducto = producto.codigo
    let $tdFormulario = crearFormulario(codigoProducto)
    $fila.insertAdjacenteElement('beforeend', $tdFormulario)
    
    // retorna un tr
    return $fila;
}


const crearFormulario = (codProducto) => {
    
    let $td = d.createElement('td')
    
    let $formAdd = d.createElement('form')
    $formAdd = setAttribute('action','')
    $td.appendChild($formAdd)
    
    let $input = d.createElement('input')
    $input.setAttribute('type', 'number')
    $input.setAttribute('name', 'unidades')
    $input.setAttribute('min', 1)
    $input.dataset.codigo = codProducto
    $formAdd.appendChild($input)
    
    let $btn = d.createElement('input')
    $btn.setAttribute('type', 'submit')
    $btn.setAttribute('name', 'add')
    $btn.setAttribute('value', 'Añadir')
    $formAdd.insertAdjacentElement('beforeend', $btn)
    
    $form.addEventListener('submit', (ev) => {
        // evitar que recargue la página
        ev.target.preventDefault()
        
        // recoger unidades
        let unidades = ev.target.querySelector('[name="unidades"]').value
        // let codigo = ev.target.querySelector('[name="unidades"]').dataset.codigo
        // anadirProductos(codigo,unidades)
        anadirProductos(codProducto, unidades)
    })
    
    return $td
}

const anadirProductos = (codProducto, unidades) => {
    
}

const error = (message) => {
    // qué hacer en caso de error
}

