

// mostrar Ocultar Senha

function mostrarOcultarSenhaEmail(){
    let olhoSenhaEmail = document.querySelector("#olhoSenhaEmail")
    let senha=document.querySelector("#txtSenhaEmail")
    if(senha.type=="password"){
        senha.type = "text"
        olhoSenhaEmail.innerHTML = "<i class='bi bi-eye text-start' ></i>"
    }else{
        senha.type="password"
        olhoSenhaEmail.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>"
    }
}

function mostrarOcultarSenha(){
    let olhoSenha = document.querySelector("#olhoSenha")
    let senha=document.querySelector("#txtSenha")
    if(senha.type=="password"){
        senha.type = "text"
        olhoSenha.innerHTML = "<i class='bi bi-eye text-start' ></i>"
    }else{
        senha.type="password"
        olhoSenha.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>"
    }
}
    
function mostrarOcultarNovaSenha(){
    let olhoNovaSenha = document.querySelector("#olhoNovaSenha")
    let senha=document.querySelector("#txtNovaSenha")
    if(senha.type=="password"){
        senha.type = "text"
        olhoNovaSenha.innerHTML = "<i class='bi bi-eye text-start' ></i>"
    }else{
        senha.type="password"
        olhoNovaSenha.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>"
    }
}

function mostrarOcultarSenhaExcluirConta(){
    let olhoSenhaExcluirConta = document.querySelector("#olhoSenhaExcluirConta")
    let senha=document.querySelector("#txtSenhaExcluirConta")
    if(senha.type=="password"){
        senha.type = "text"
        olhoSenhaExcluirConta.innerHTML = "<i class='bi bi-eye text-start' ></i>"
    }else{
        senha.type="password"
        olhoSenhaExcluirConta.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>"
    }
}






// coloca traço no telefone

let telefone = document.querySelector("#txtTelefone")

telefone.addEventListener("keypress", mask.bind(null, telefone))

function mask(telefone){
    if(telefone.value.length == 5){
        telefone.value += "-"
    }
}

// pular campo input
let ddd = document.querySelector("#txtDDD")
ddd.addEventListener("keypress", pularCampoTelefone.bind(null,ddd, telefone))

function pularCampoTelefone(campoAtual,proximoCampo){
    setTimeout(function() {
        if(campoAtual.value.length == 2){
            proximoCampo.focus()}
      }, 1);
}






