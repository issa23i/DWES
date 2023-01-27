// CONSTANTES
const d = document


// LISTENERS
window.addEventListener('load', () => {
    cargarProductos()
    cargarCesta()
})

/***/


// FUNCIONES
/**
 const cargarProductos = async () => {
 let ruta = '../controlador/productos_json.php'
 try{
 let respuesta = await fetch(ruta)
 let respuestaOk = await respuesta.ok
 if (respuestaOk) {
 let productos = await respuesta.json()
 }
 
 } catch (err) {
 console.error('No se obtuvo respuesta de '+ ruta + ' ' + err )
 }
 // para que no se siga el link que llama a esta funciónn
 return false;
 }*/


const cargarProductos = () => {
    let xhr = new XMLHttpRequest()
    let productos = ''

    xhr.addEventListener('readystatechange', e => {
        // continuar hasta que readyState sea 4
        if (xhr.readyState !== 4)
            return
        // si código éxito 200 - 299
        if (xhr.status >= 200 && xhr.status < 300) {
            productos = JSON.parse(xhr.responseText)
            crearTablaProductos(productos)
        } else {
            let message = xhr.statusText || "Ocurrió un error"
            error(message) // hacer algo con el error
        }
    })
    xhr.open('GET', '../controlador/productos_json.php', true)
    xhr.send()
    
    crearTablaProductos(productos)
}

const crearTablaProductos = (productos) => {

    if (productos.length > 0) {
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
        $tr.insertAdjacentElement('beforeend', $thAdd)

        let $thCodigo = d.createElement('th')
        $thCodigo.textContent = 'Código'
        $tr.insertAdjacentElement('beforeend', $thCodigo)

        let $thNombre = d.createElement('th')
        $thNombre.textContent = 'Nombre'
        $tr.insertAdjacentElement('beforeend', $thNombre)

        let $thPVP = d.createElement('th')
        $thPVP.textContent = 'PVP'
        $tr.insertAdjacentElement('beforeend', $thPVP)

        let $tbody = d.createElement('tbody')
        $thead.insertAdjacentElement('afterend', $tbody)

        productos.forEach(producto => {
            let $fila = crearFila(producto)
            $tbody.insertAdjacentElement('beforeend', $fila)
        });
    }
}

const crearFila = (producto) => {

    // crear una fila de producto 
    let $fila = d.createElement('tr')

    //crear formulario en cada fila
    //crearFormulario(textoBoton, codProducto, funcion) // la funcion añadir producto
    let codigoProducto = producto.codigo
    let $tdFormulario = crearFormulario('Añadir', codigoProducto)
    $fila.insertAdjacentElement('beforeend', $tdFormulario)


    let $tdPVP = d.createElement('td')
    $tdPVP.textContent = producto.codigo
    $fila.insertAdjacentElement('beforeend', $tdPVP)


    let $tdNombre = d.createElement('td')
    $tdNombre.textContent = producto.nombre_corto
    $fila.insertAdjacentElement('beforeend', $tdNombre)

    let $tdCod = d.createElement('td')
    $tdCod.textContent = producto.PVP
    $fila.insertAdjacentElement('beforeend', $tdCod)


    // retorna un tr
    return $fila;
}


const crearFormulario = (textoBtn, codProducto) => {

    let $td = d.createElement('td')

    let $formAdd = d.createElement('form')
    $td.appendChild($formAdd)

    let $input = d.createElement('input')
    $input.setAttribute('type', 'number')
    $input.setAttribute('name', 'unidades')
    $input.setAttribute('min', 1)
    $input.dataset.codigo = codProducto
    $input.id = 'unidades'
    $formAdd.appendChild($input)

    let $btn = d.createElement('input')
    $btn.setAttribute('type', 'submit')
    $btn.setAttribute('name', 'add')
    $btn.setAttribute('value', textoBtn)
    $formAdd.insertAdjacentElement('beforeend', $btn)

    $formAdd.addEventListener('submit', ev => {
        // evitar que recargue la página
        ev.preventDefault()
        anadirProducto(codProducto)
    })

    return $td
}

const anadirProducto = (cod) => {

    // recoger datos
    let $input = d.querySelector("[data-codigo='" + cod + "']")
    let unidades = $input.value
    // poner vacío el input
    $input.value = ''
    let codigo = cod

    // objeto a enviar en el post
    let data = "cod=" + codigo + "&unid=" + unidades

    // Cestacompra->carga_articulo($cod, $unidades)
    // hacer una petición POST
    let xhr = new XMLHttpRequest()

    xhr.addEventListener('readystatechange', e => {
        // continuar hasta que readyState sea 4
        if (xhr.readyState !== 4)
            return
        // si código éxito 200 - 299
        if (xhr.status >= 200 && xhr.status < 300) {
            console.log(xhr.responseText)
        } else {
            let message = xhr.statusText || "Ocurrió un error"
            error(message) // hacer algo con el error
        }
    })
    xhr.open('POST', '../controlador/anadir_json.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8')
    xhr.send(data)

    cargarCesta()
}

const cargarCesta = () => {

    let xhr = new XMLHttpRequest()

    xhr.addEventListener('readystatechange', e => {
        // continuar hasta que readyState sea 4
        if (xhr.readyState !== 4)
            return
        // si código éxito 200 - 299
        if (xhr.status >= 200 && xhr.status < 300) {
            let cesta = JSON.parse(xhr.responseText)
            mostrarCesta(cesta)
        } else {
            let message = xhr.statusText || "Ocurrió un error"
            error(message) // hacer algo con el error
        }
    })
    xhr.open('GET', '../controlador/cesta_json.php', true)
    xhr.send()

}

const mostrarCesta = (cesta) => {
    
    // borrar la tabla si existe, para crearla de nuevo actualizada
    let $divCesta = d.getElementById('cesta')
    let $div = $divCesta.querySelector('div')
    if ($div) {
        $div.remove()
    }
  

    // el contenido dinámico irá justo después de la etiqueta hr
    let $hr = $divCesta.querySelector('hr')

    // comprobar si la cesta está vacía, mostrar mensaje
    if (Object.keys(cesta).length <= 0) {
        $p = d.createElement('p')
        $p.textContent = "Cesta Vacía"
        $hr.insertAdjacentElement('afterend',$p)
        
    } else { // si la cesta tiene productos, crear tabla
        $div = d.createElement('div')
        $hr.insertAdjacentElement('afterend', $div)
        
        $tablaCesta = d.createElement('table')
        $tablaCesta.setAttribute('class','table')
        $divCesta.appendChild($tablaCesta)

        let $thead = d.createElement('thead')
        $tablaCesta.appendChild($thead)

        let $trCabecera = d.createElement('tr')
        $thead.appendChild($trCabecera)

        let $tdCabeceraCodigo = d.createElement('td')
        $tdCabeceraCodigo.textContent = 'Código'
        $trCabecera.appendChild($tdCabeceraCodigo)

        let $tdCabeceraNombre = d.createElement('td')
        $tdCabeceraNombre.textContent = 'Nombre'
        $trCabecera.appendChild($tdCabeceraNombre)

        let $tdCabeceraPrecio = d.createElement('td')
        $tdCabeceraPrecio.textContent = 'Precio'
        $trCabecera.appendChild($tdCabeceraPrecio)

        let $tdCabeceraUnidades = d.createElement('td')
        $tdCabeceraUnidades.textContent = 'Unidades'
        $trCabecera.appendChild($tdCabeceraUnidades)
        
        let $tbody = d.createElement('tbody')
        $thead.insertAdjacentElement('afterend',$tbody)
        
        // por cada producto en la cesta
        Object.entries(cesta).forEach(([key,value])=> {
            
            let $trProducto = d.createElement('tr')
            $tbody.insertAdjacentElement('beforeend', $trProducto)
            
            let $tdCodigoProducto = d.createElement('td')
            $tdCodigoProducto.textContent = value.producto.codigo
            $trProducto.insertAdjacentElement('beforeend', $tdCodigoProducto)
            
            let $tdNombreProducto = d.createElement('td')
            $tdNombreProducto.textContent = value.producto.nombre_corto
            $trProducto.insertAdjacentElement('beforeend', $tdNombreProducto)
            
            let $tdPVPProducto = d.createElement('td')
            $tdPVPProducto.textContent = value.producto.PVP
            $trProducto.insertAdjacentElement('beforeend', $tdPVPProducto)
            
            let $tdUnidadesProducto = d.createElement('td')
            $tdUnidadesProducto.textContent = value.unidades
            $trProducto.insertAdjacentElement('beforeend', $tdUnidadesProducto)
        })
        
        // botón comprar
        let $formularioComprar = d.createElement('form')
        $tablaCesta.insertAdjacentElement('afterend',$formularioComprar)
        $formularioComprar.id = 'comprar'
        $formularioComprar.action = "../controlador/cesta.php"
        $formularioComprar.method = 'POST'
        
        let $btnComprar = d.createElement('input')
        $formularioComprar.appendChild($btnComprar)
        $btnComprar.type = 'submit'
        $btnComprar.name = 'comprar'
        $btnComprar.value = 'Comprar'
        
        // botón vaciar cesta
        let $formularioVaciar = d.createElement('form')
        $tablaCesta.insertAdjacentElement('afterend',$formularioVaciar)
        $formularioVaciar.id = 'vaciar'
        $formularioVaciar.action = "/DWES/UT6Ejercicio1/controlador/listado_productos.php?vaciar=1"
        $formularioVaciar.method = 'POST'
        
        let $btnVaciar = d.createElement('input')
        $formularioVaciar.appendChild($btnComprar)
        $btnVaciar.type = 'submit'
        $btnVaciar.name = 'vaciar'
        $btnVaciar.value = 'Vaciar Cesta'
    }

}
const error = (message) => {
    // qué hacer en caso de error
}

