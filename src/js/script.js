// mostrar Ocultar Senha

function mostrarOcultarSenhaEmail() {
    let olhoSenhaEmail = document.querySelector("#olhoSenhaEmail")
    let senha = document.querySelector("#txtSenhaEmail")
    if (senha.type == "password") {
        senha.type = "text"
        olhoSenhaEmail.innerHTML = "<i class='bi bi-eye text-start' ></i>"
    } else {
        senha.type = "password"
        olhoSenhaEmail.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>"
    }
}

function mostrarOcultarSenha() {
    let olhoSenha = document.querySelector("#olhoSenha")
    let senha = document.querySelector("#txtSenha")
    if (senha.type == "password") {
        senha.type = "text"
        olhoSenha.innerHTML = "<i class='bi bi-eye text-start' ></i>"
    } else {
        senha.type = "password"
        olhoSenha.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>"
    }
}

function mostrarOcultarNovaSenha() {
    let olhoNovaSenha = document.querySelector("#olhoNovaSenha")
    let senha = document.querySelector("#txtNovaSenha")
    if (senha.type == "password") {
        senha.type = "text"
        olhoNovaSenha.innerHTML = "<i class='bi bi-eye text-start' ></i>"
    } else {
        senha.type = "password"
        olhoNovaSenha.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>"
    }
}

function mostrarOcultarSenhaExcluirConta() {
    let olhoSenhaExcluirConta = document.querySelector("#olhoSenhaExcluirConta")
    let senha = document.querySelector("#txtSenhaExcluirConta")
    if (senha.type == "password") {
        senha.type = "text"
        olhoSenhaExcluirConta.innerHTML = "<i class='bi bi-eye text-start' ></i>"
    } else {
        senha.type = "password"
        olhoSenhaExcluirConta.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>"
    }
}

//funçao do joao dos bottoes, nao mexer pq nao funciono o do max,
//sim tive que fazer o meu infelizmente

function viewSenha() {
    let inputPass = document.getElementById("passwordInput")
    let iconPassBtn = document.getElementById("iconPassword")

    if (inputPass.type === "password") {
        inputPass.setAttribute("type", "text")
        iconPassBtn.classList.replace("bi-eye-fill", "bi-eye-slash-fill")
    } else {
        inputPass.setAttribute("type", "password")
        iconPassBtn.classList.replace("bi-eye-slash-fill", "bi-eye-fill")
    }
}

function viewSenhaCad() {
    let inputConfirmPass = document.getElementById("inputConfirmPass")
    let iconConfirmPass = document.getElementById("icontogleConfirmPass")

    if (inputConfirmPass.type === "password") {
        inputConfirmPass.setAttribute("type", "text")
        iconConfirmPass.classList.replace("bi-eye-fill", "bi-eye-slash-fill")
    } else {
        inputConfirmPass.setAttribute("type", "password")
        iconConfirmPass.classList.replace("bi-eye-slash-fill", "bi-eye-fill")
    }
}


// mensagem = document.querySelector(".desabilitarMenssagem")
// setTimeout(function () {
//     mensagem.style.visibility = "hidden"
//     mensagem.style.height = 0
//     mensagem.style.padding = 0
//     mensagem.style.margin= 0
//     mensagem.innerHTML = ""
// }, 4000)


// botao.disabled = true
// botao.setAttribute("disabled", "disabled")



//questionario hidden text area
function toggleTextarea(id, show) {
    var textarea = document.getElementById(id);
    if (show) {
        textarea.style.display = 'block';
    } else {
        textarea.style.display = 'none';
    }
}