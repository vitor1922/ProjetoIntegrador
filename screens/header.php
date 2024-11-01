<!-- header magrooooo demais! -->
<!--Poha Malinski -->

<header class="">
    <div class=" container-fluid">
        <div class="row header-vii">
            <div class="col-12 d-flex justify-content-center m-1 mt-1 mb-2">
                <a href="https://www.pr.senac.br/principal/"><img src="<?= BASE_URL ?>assets/img/logoSenac.png" alt="logo senac" class="img-logo-senac " href=""></a>
            </div>
        </div>
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
                                    <a class="nav-link" href="#">Sobre</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./verTodosServiços.php">Serviços</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./agendamento.php">Agendar Horário</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Fale Conosco</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="#">Blog</a>
                                    </li>
                                <?php if($perfil=== 'admin' || $perfil === "professor"){?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Area do Instrutor</a>
                                    </li>
                                <?php }?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header-vi">
                    <img src="<?= BASE_URL ?>assets/img/logoSenac.png" alt="logo senac" class="img-logo-senac header-vi my-1">
                </div>
                <div class="nav-item dropstart">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-5"><?= $perfil?></i>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if($_SESSION['logado'] == true){?>
                            <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                            <li><a class="dropdown-item" href="perfil.php">Log Out</a></li>
                            <?php }else{?>
                        <li><a class="dropdown-item" href="./signUp.php">Cadastrar</a></li>
                        <li><a class="dropdown-item" href="#">Login</a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>