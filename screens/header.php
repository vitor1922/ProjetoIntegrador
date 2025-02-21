<?php

$nome = isset($_SESSION['nome']) && !empty($_SESSION['nome']) ? $_SESSION['nome'] : "Registra-se";

// Se não for "Visitante", extrai o primeiro nome
$primeiroNome = $nome !== "Visitante" ? explode(" ", $nome)[0] : "Visitante";

?>


<header>
    <div class=" header-vii">

    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-0 my-0">
        <div class="container-fluid header-senac">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class=" align-items-center offcanvas-body nav-cor justify-content-between">
                    <div class="d-flex justify-content-center mt-1 mb-2 ps-lg-5">
                        <a href="https://www.pr.senac.br/principal/"><img src="<?= BASE_URL ?>assets/img/logoSenac.png" alt="logo senac" class="img-logo-senac " href=""></a>
                    </div>
                    <div class="text-center mx-auto">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold pe-3">

                            <li class="nav-item">
                                <a class="nav-link header-senac-text" aria-current="page" href="<?= BASE_URL ?>index.php">Início</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link header-senac-text" href="<?= BASE_URL ?>screens/verTodosServicos.php">Serviços</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link header-senac-text" href="<?= BASE_URL ?>screens/agendamento.php">Agendar Horário</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link header-senac-text" href="<?= BASE_URL ?>screens/blog.php">Blog</a>
                            </li>
                            <?php if ($perfil === 'admin' || $perfil === "professor") { ?>
                                <li class="nav-item">
                                    <a class="nav-link header-senac-text" href="<?= BASE_URL ?>screens/areaInstrutorTeste.php">Área do Instrutor</a>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="header-vi justify-content-center">
                <img src="<?= BASE_URL ?>assets/img/logoSenac.png" alt="logo senac" class="img-logo-senac header-vi my-1">
            </div>
            <div class="nav-item dropdown header-senac-text">
                <a class="nav-link mx-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-5">
                        <span class="d-none d-lg-inline">
                            <?= htmlspecialchars($primeiroNome) ?>
                        </span>
                    </i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end bg-white">
                    <?php if ($logado) { ?>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>screens/Perfil.php">Perfil</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>screens/configuracoes.php">Configurações</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>src/logicos/logOut.php">Sair</a></li>
                    <?php } else { ?>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>screens/signUp.php">Login</a></li>
                    <?php } ?>
                </ul>


            </div>
        </div>
    </nav>

</header>
<!-- </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-0 my-0 border-bottom border-1 border-black">
        <div class="container-fluid header-senac">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start " data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class=" offcanvas-body nav-cor d-flex justify-content-center">
                    <div class="text-center">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold">

                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="<?= BASE_URL ?>index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>index.php#sobre">Sobre</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>screens/verTodosServicos.php">Serviços</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>screens/agendamento.php">Agendar Horário</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>index.php#contato">Fale Conosco</a>
                            </li>                           
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>screens/blog.php">Blog</a>
                            </li>
                            <?php if ($perfil === 'admin' || $perfil === "professor") { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL ?>screens/areaInstrutor.php">Área do Instrutor</a>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="header-vi">
                <img src="<?= BASE_URL ?>assets/img/logoSenac.png" alt="logo senac" class="img-logo-senac header-vi my-1">
            </div>
            <div class="nav-item dropdown">
                <a class="nav-link mx-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-5"><?= htmlspecialchars($primeiroNome) ?></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end bg-white">
                    <?php if ($logado) { ?>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>screens/Perfil.php">Perfil</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>screens/configuracoes.php">Configurações</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>src/logicos/logOut.php">Logout</a></li>
                    <?php } else { ?>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>screens/signUp.php">Login</a></li>
                    <?php } ?>
                </ul>


            </div>
        </div>
    </nav> -->

</header>