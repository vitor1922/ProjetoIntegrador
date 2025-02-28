<!-- preload.php -->
<style>
    .preloader {
        position: fixed;
        width: 100%;
        height: 100%;
        background: #0A0617;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
    }
    .logo {
        width: 150px;
        /* Ajuste o tamanho conforme necessário */
        animation: pulse 1s infinite;
        /* Animação de pulsar */
    }
    @keyframes pulse {
        0%,
        100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }
</style>

<div class="preloader" id="preloader">
    <img src="../assets/img/senac_logo_branco.png" class="logo" alt="Logo do Senac"> <!-- Substitua pelo caminho correto da logo -->
</div>

<script>
    // Usando o evento DOMContentLoaded para garantir que o código será executado quando o HTML estiver carregado
    document.addEventListener('DOMContentLoaded', function() {
        // Tempo do preloader de 3 segundos
        setTimeout(function() {
            document.getElementById("preloader").style.display = "none"; // Esconde o preloader após 3 segundos
        }, 3000); // Ajuste o tempo aqui se necessário
    });
</script>