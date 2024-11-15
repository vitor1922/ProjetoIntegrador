// coloca traço no telefone

let telefone = document.querySelector("#txtTelefone")



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
