<!-- header magrooooo demais! -->

<header>
    <div class=" container-fluid  ">
        <div class="row header-vii">
            <div class="col-12 d-flex justify-content-center m-1">
                <img src="<?= BASE_URL ?>assets/img/logoSenac.png" alt="logo senac" class="img-logo-senac ">
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
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Sobre</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Serviços</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Agendar Horário</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Fale Conosco</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header-vi">
                    <img src="<?= BASE_URL ?>assets/img/logoSenac.png" alt="logo senac" class="img-logo-senac header-vi">
                </div>
                <div class="nav-item dropstart">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./singUp.php">Cadastrar</a></li>
                        <li><a class="dropdown-item" href="#">login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>