<?php include("../constantes.php") ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>

    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column justify-content-between">
    <div>
        <?php include("./header.php") ?>

        <main>
            <div class=" container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href=""><i class="bi bi-arrow-left-short fs-1"></i></a>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <h2 class=" laranja-senac fw-bold">Configurações</h2>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class=" offset-1 col-11">
                        <p class="fw-bold fs-5">Geral</p>
                    </div>
                </div>
                <!-- alterar email -->
                <div class="d-grid col-lg-8 text-start offset-1 me-5 mb-3">
                    <button class="btn shadow-sm bg-cinza" data-bs-toggle="modal" data-bs-target="#modalEmail">
                        <div class="row text-start ">
                            <div class="  col-10 ">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="p-0 m-0 fw-bold ">Alterar Email</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p class="p-0 m-0">nome@email.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 align-self-center text-end">
                                <i class="bi bi-chevron-right fs-3 "></i>
                            </div>
                        </div>
                    </button>
                </div>
                <!-- alterar senha -->
                <div class="d-grid col-lg-8 text-start offset-1 me-5 mb-3">
                    <button class="btn shadow-sm bg-cinza button">
                        <div class="row text-start ">
                            <div class="  col-10 ">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="p-0 m-0 fw-bold ">Alterar Senha</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p class="p-0 m-0">****************</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 align-self-center text-end">
                                <i class="bi bi-chevron-right fs-3 "></i>
                            </div>
                        </div>
                    </button>
                </div>
                <!-- alterar telefone -->
                <div class="d-grid col-lg-8 text-start offset-1 me-5 mb-3">
                    <button class="btn shadow-sm bg-cinza">
                        <div class="row text-start ">
                            <div class="  col-10 ">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="p-0 m-0 fw-bold ">Alterar Telefone</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p class="p-0 m-0">+55 41 99999-9999</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 align-self-center text-end">
                                <i class="bi bi-chevron-right fs-3 "></i>
                            </div>
                        </div>
                    </button>
                </div>
                <!-- notificações -->
                <div class="row mt-5">
                    <div class=" offset-1 col-11">
                        <p class="fw-bold fs-5">Notificações</p>
                    </div>
                </div>
                <div class="d-grid col-lg-8 text-start offset-1 me-5 mb-3">
                    <button class="btn shadow-sm bg-cinza ">
                        <div class="row text-start ">
                            <div class="  col-10 align-self-center">
                                <p class="p-0 m-0 fw-bold ">Aceitar receber notificações por email ou telefone</p>
                            </div>
                            <div class="col-2 align-self-center text-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input fs-3" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                </div>
                            </div>
                        </div>
                    </button>
                </div>
                <!-- avançado -->
                <div class="row mt-5">
                    <div class=" offset-1 col-11">
                        <p class="fw-bold fs-5">Avançado</p>
                    </div>
                </div>
                <div class="d-grid col-lg-8 text-start offset-1 me-5 mb-3">
                    <button class="btn shadow-sm bg-cinza ">
                        <div class="row text-start ">
                            <div class="  col-10 align-self-center">
                                <p class="p-0 m-0 fw-bold text-danger fs-5">EXCLUIR CONTA</p>
                            </div>
                            <div class="col-2 align-self-center text-end ">
                                <i class="bi bi-exclamation-triangle-fill text-danger fs-2"></i>
                            </div>
                        </div>
                    </button>
                </div>

                <!-- modais -->
                <!-- modal email -->
                <div class="modal fade" id="modalEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Novo Email</label>
                                        <input type="email" class="form-control" id="txtEmail" name="txtEmail">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Senha</label>
                                        <div class="row">
                                            <div class="col-11 position-relative">
                                                <input type="password" class="form-control " id="txtSenha" name="txtSenha">
                                            </div>
                                            <div class="col-1" >
                                                <i class="bi bi-eye text-start"></i>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>








                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </main>
    </div>

    <?php include_once("./footer.php") ?>




    <script src="../src/bootstrap/js/bootstrap.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>