// coloca traço no telefone

let telefone = document.querySelector("#txtTelefone")

telefone.addEventListener("keypress", mask.bind(null, telefone))

function mask(telefone) {
    if (telefone.value.length == 5) {
        telefone.value += "-"
    }
}

// pular campo input
let ddd = document.querySelector("#txtDDD")
ddd.addEventListener("keypress", pularCampoTelefone.bind(null, ddd, telefone))

function pularCampoTelefone(campoAtual, proximoCampo) {
    setTimeout(function () {
        if (campoAtual.value.length == 2) {
            proximoCampo.focus()
        }
    }, 1);
}
