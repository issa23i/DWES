// mensajes emergentes borrados tras 7 segundos,
// y ocultos si no tienen contenido contenido

const $infos = document.querySelectorAll('.alert-info')

for (const it of $infos) {
    setTimeout(() => {it.remove()},7000)
}


