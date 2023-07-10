//Formulario y boton
let formulario = document.getElementById('formulario');
let btnEnviar = document.getElementById('btnenviar');

let nom = document.getElementById('nom')
let peso = document.getElementById('peso')
let fecha = document.getElementById('fecha')


let soloNumeros = (e) => {
    // validamos que el keyCode corresponda a las teclas de los números
    if ((e.keyCode < 48 || e.keyCode > 57) && e.keyCode) {
        e.preventDefault()
    }
}

let enviarFormulario = formulario => {
    console.log(formulario)
    formulario.submit()
}

const validacion = (e) => {
    e.preventDefault()
    if (nom.value === "") {
        alert('Por favor, ingrese nombre')
        nom.focus()
        return false
    }
    if (peso.value === "") {
        alert('Por favor, escribe el peso')
        peso.focus()
        return false
    }


    enviarFormulario(formulario)
}

peso.addEventListener('keypress', soloNumeros)


btnEnviar.addEventListener('click', validacion)