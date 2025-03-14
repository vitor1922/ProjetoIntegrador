// mostrar Ocultar Senha

function mostrarOcultarSenhaEmail() {
  let olhoSenhaEmail = document.querySelector("#olhoSenhaEmail");
  let senha = document.querySelector("#txtSenhaEmail");
  if (senha.type == "password") {
    senha.type = "text";
    olhoSenhaEmail.innerHTML = "<i class='bi bi-eye text-start' ></i>";
  } else {
    senha.type = "password";
    olhoSenhaEmail.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>";
  }
}

function mostrarOcultarSenha() {
  let olhoSenha = document.querySelector("#olhoSenha");
  let senha = document.querySelector("#txtSenha");
  if (senha.type == "password") {
    senha.type = "text";
    olhoSenha.innerHTML = "<i class='bi bi-eye text-start' ></i>";
  } else {
    senha.type = "password";
    olhoSenha.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>";
  }
}

function mostrarOcultarNovaSenha() {
  let olhoNovaSenha = document.querySelector("#olhoNovaSenha");
  let senha = document.querySelector("#txtNovaSenha");
  if (senha.type == "password") {
    senha.type = "text";
    olhoNovaSenha.innerHTML = "<i class='bi bi-eye text-start' ></i>";
  } else {
    senha.type = "password";
    olhoNovaSenha.innerHTML = "<i class='bi bi-eye-slash text-start' ></i>";
  }
}

function mostrarOcultarSenhaExcluirConta() {
  let olhoSenhaExcluirConta = document.querySelector("#olhoSenhaExcluirConta");
  let senha = document.querySelector("#txtSenhaExcluirConta");
  if (senha.type == "password") {
    senha.type = "text";
    olhoSenhaExcluirConta.innerHTML = "<i class='bi bi-eye text-start' ></i>";
  } else {
    senha.type = "password";
    olhoSenhaExcluirConta.innerHTML =
      "<i class='bi bi-eye-slash text-start' ></i>";
  }
}

//funçao do joao dos bottoes, nao mexer pq nao funciono o do max,
//sim tive que fazer o meu infelizmente

function viewSenha() {
  let inputPass = document.getElementById("passwordInput");
  let iconPassBtn = document.getElementById("iconPassword");

  if (inputPass.type === "password") {
    inputPass.setAttribute("type", "text");
    iconPassBtn.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
  } else {
    inputPass.setAttribute("type", "password");
    iconPassBtn.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
  }
}

function viewSenhaCad() {
  let inputConfirmPass = document.getElementById("inputConfirmPass");
  let iconConfirmPass = document.getElementById("icontogleConfirmPass");

  if (inputConfirmPass.type === "password") {
    inputConfirmPass.setAttribute("type", "text");
    iconConfirmPass.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
  } else {
    inputConfirmPass.setAttribute("type", "password");
    iconConfirmPass.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
  }
}

function viewSenhaNova() {
  let inputConfirmPassSenha = document.getElementById("confirmarNovaSenha");
  let iconConfirmPassSenha = document.getElementById("iconPasswordSenha");

  if (inputConfirmPassSenha.type === "password") {
    inputConfirmPassSenha.setAttribute("type", "text");
    iconConfirmPassSenha.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
  } else {
    inputConfirmPassSenha.setAttribute("type", "password");
    iconConfirmPassSenha.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
  }
}


function toggleTextarea(id, show) {
  var textarea = document.getElementById(id);
  if (show) {
    textarea.style.display = "block";
  } else {
    textarea.style.display = "none";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const inputImagem = document.getElementById("inputImagem");
  const imagemPreview = document.getElementById("imagemPreview");
  let cropper;

  inputImagem.addEventListener("change", function (event) {
    const file = event.target.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imagemPreview.src = e.target.result;

        // Se já existe um cropper, destruí-lo antes de criar um novo
        if (cropper) {
          cropper.destroy();
        }

        cropper = new Cropper(imagemPreview, {
          aspectRatio: 1, // Define a proporção do corte (1:1, quadrado)
          viewMode: 2,
        });
      };

      reader.readAsDataURL(file);
    }
  });

  document
    .getElementById("cortarImagem")
    .addEventListener("click", function () {
      if (cropper) {
        const canvas = cropper.getCroppedCanvas();
        document
          .getElementById("resultado")
          .getContext("2d")
          .drawImage(canvas, 0, 0);
      }
    });
});

// do zezinho
function updateLabel(input) {
  let fileLabel = document.getElementById("fileLabel");
  fileLabel.textContent =
    input.files.length > 0 ? input.files[0].name : "Nenhum arquivo selecionado";
}

function previewImage(input, imgId) {
  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById(imgId).src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}
let cropper;
let currentImageTarget;
let currentInputFile;

function openCropModal(input, imgId) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("cropImage").src = e.target.result;
            currentImageTarget = imgId; // Guarda qual imagem será alterada
            currentInputFile = input; // Guarda o input original
            let modal = new bootstrap.Modal(document.getElementById("cropModal"));
            modal.show();
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('cropModal').addEventListener('shown.bs.modal', function () {
    let image = document.getElementById("cropImage");
    cropper = new Cropper(image, {
        aspectRatio: currentImageTarget === 'bannerPreview' ? 3 : 1,
        viewMode: 2,
        autoCropArea: 1
    });
});

document.getElementById('cropModal').addEventListener('hidden.bs.modal', function () {
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
});

document.getElementById("cropButton").addEventListener("click", function () {
    let canvas = cropper.getCroppedCanvas();
    if (canvas) {
        document.getElementById(currentImageTarget).src = canvas.toDataURL();

        canvas.toBlob(function (blob) {
            let file = new File([blob], "cropped_image.jpg", { type: "image/jpeg" });
            let dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            currentInputFile.files = dataTransfer.files;
        }, "image/jpeg");
    }

    let modal = bootstrap.Modal.getInstance(document.getElementById("cropModal"));
    modal.hide();
});

function removerImagem(tipo) {
  if (!confirm("Tem certeza que deseja remover esta imagem?")) return;

  fetch('../src/logicos/removerImagem.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `tipo=${tipo}`
  })
  .then(response => response.text())
  .then(data => {
      if (data.trim() === 'sucesso') {
          if (tipo === 'banner') {
              document.getElementById('bannerPreview').src = '../assets/img/sem-banner.png';
              document.querySelector('input[name="imgBanner"]').value = '';
          } else if (tipo === 'perfil') {
              document.getElementById('fotoPreview').src = '../assets/img/sem-perfil.png';
              document.querySelector('input[name="imgName"]').value = '';
          }
      } else {
          alert('Erro ao remover a imagem.');
      }
  })
  .catch(error => console.error('Erro na requisição:', error));
}