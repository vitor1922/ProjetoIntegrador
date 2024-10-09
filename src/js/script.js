

// mostrar Ocultar Senha
let olhoSenhaEmail = document.querySelector("#olhoSenhaEmail")
olhoSenhaEmail.addEventListener("click", mostrarOcultarSenhaEmail)

let olhoSenha = document.querySelector("#olhoSenha")
olhoSenha.addEventListener("click", mostrarOcultarSenha)

let olhoNovaSenha = document.querySelector("#olhoNovaSenha")
olhoNovaSenha.addEventListener("click", mostrarOcultarNovaSenha)

let olhoSenhaExcluirConta = document.querySelector("#olhoSenhaExcluirConta")
olhoSenhaExcluirConta.addEventListener("click", mostrarOcultarSenhaExcluirConta)

function mostrarOcultarSenhaEmail(){
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
    let senha=document.querySelector("#txtSenhaExcluirConta")
    if(senha.type=="password"){
        senha.type = "text"
        olhoSenha.innerHTML = "<i class='bi bi-eye text-start' ></i>"
    }else{
        senha.type="password"
        olhoSenha.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>"
    }
}


// mostrar ocultar senha joão
function mostraSenha() {
    const passwordInput = document.getElementById('passwordLogar');
    const toggleIcon = document.getElementById('btn-senha');

    // Alternar entre texto e senha
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill'); // Alterar ícone para olho cortado
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill'); // Voltar para ícone de olho
    }
}

// Event Listener no botão de ícone
document.getElementById('btn-senha').addEventListener('click', mostraSenha);




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






