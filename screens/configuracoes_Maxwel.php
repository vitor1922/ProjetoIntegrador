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
                        <a href=""><i class="bi bi-arrow-left-short fs-1 azul-senac"></i></a>
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
                    <button class="btn shadow-sm btn-cinza" data-bs-toggle="modal" data-bs-target="#modalEmail">
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
                    <button class="btn shadow-sm btn-cinza button " data-bs-toggle="modal" data-bs-target="#modalSenha">
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
                    <button class="btn shadow-sm btn-cinza" data-bs-toggle="modal" data-bs-target="#modalTelefone">
                        <div class="row text-start ">
                            <div class="  col-10 ">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="p-0 m-0 fw-bold ">Alterar Telefone</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p class="p-0 m-0">41 99999-9999</p>
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
                    <button class="btn shadow-sm btn-cinza ">
                        <div class="row text-start ">
                            <div class="  col-10 align-self-center">
                                <p class="p-0 m-0 fw-bold ">Aceitar receber notificações por email ou telefone</p>
                            </div>
                            <div class="col-2 align-self-center">
                                <div class="form-check form-switch d-flex justify-content-end ">
                                    <input class="form-check-input fs-3 text-end" type="checkbox" role="switch" id="flexSwitchCheckDefault">
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
                    <button class="btn shadow-sm btn-cinza " data-bs-toggle="modal" data-bs-target="#modalExcluirConta">
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
                <!-- modal alterar email -->
                <div class="modal fade" id="modalEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <form action="">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Novo Email</label>
                                        <input type="email" class="form-control" name="txtEmail">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold ">Senha</label>
                                        <div class="row">
                                            <div class="col-12 position-relative">
                                                <input type="password" class="form-control bg-warning-subtle" id="txtSenhaEmail" name="txtSenha">
                                            </div>
                                            <div class="col-1 position-absolute align-self-center left-90 olho-senha" id="olhoSenhaEmail">
                            
                                                    <i class="bi bi-eye-slash text-start" ></i> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex flex-column justify-content-center align-items-center mt-5">
                                        <label class="form-label fw-bold">PIN</label>
                                        <input type="text" class="form-control w-50" name="txtPin">
                                        <a href="">Enviar Código</a>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-center">
                                        <button class="btn  btn-azul-senac  text-white fw-bold px-5" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal alterar senha -->
                <div class="modal fade" id="modalSenha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <form action="">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Novo Email</label>
                                        <input type="email" class="form-control" name="txtEmail">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold ">Senha</label>
                                        <div class="row">
                                            <div class="col-12 position-relative">
                                                <input type="password" class="form-control bg-warning-subtle" id="txtSenha" name="txtSenha">
                                            </div>
                                            <div class="col-1 position-absolute align-self-center left-90 olho-senha" id="olhoSenha">
                            
                                                    <i class="bi bi-eye-slash text-start" ></i> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold ">Nova Senha</label>
                                        <div class="row">
                                            <div class="col-12 position-relative">
                                                <input type="password" class="form-control bg-warning-subtle" id="txtNovaSenha" name="txtNovaSenha">
                                            </div>
                                            <div class="col-1 position-absolute align-self-center left-90 olho-nova-senha" id="olhoNovaSenha">
                            
                                                    <i class="bi bi-eye-slash text-start" ></i> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex flex-column justify-content-center align-items-center mt-5">
                                        <label class="form-label fw-bold">PIN</label>
                                        <input type="text" class="form-control w-50" name="txtPin">
                                        <a href="">Enviar Código</a>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-center">
                                        <button class="btn  btn-azul-senac  text-white fw-bold px-5" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal alterar telefone -->
                <div class="modal fade" id="modalTelefone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <form action="">
                                    <div class="mb-5 pb-5 d-flex justify-content-center flex-column align-items-center">
                                        <label class="form-label fw-bold">Altere seu número de telefone</label>
                                        <div class="row">
                                            <div class=" offset-1 col-2"><input type="text" class="form-control px-1 text-center" name="txtDDD" placeholder="DDD" maxlength="2" id="txtDDD"></div>
                                            <div class="col-8"><input type="text" class="form-control" name="txtTelefone" placeholder="Telefone" maxlength="10" id="txtTelefone"></div>
                                        </div> 
                                    </div>
                                    
                                    <div class="mb-3 mt-5 d-flex justify-content-center">
                                        <button class="btn  btn-azul-senac  text-white fw-bold px-5" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal excluir conta -->
                <div class="modal fade" id="modalExcluirConta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <form action="">
                                    <div class="mb-4">
                                        <p class=" fs-5 text-danger fw-bold text-center">ESTA AÇÃO É IRREVERSSÍVEL</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold ">Senha</label>
                                        <div class="row">
                                            <div class="col-12 position-relative">
                                                <input type="password" class="form-control bg-warning-subtle" id="txtSenhaExcluirConta" name="txtSenha">
                                            </div>
                                            <div class="col-1 position-absolute align-self-center left-90 olho-senha" id="olhoSenhaExcluirConta">
                            
                                                    <i class="bi bi-eye-slash text-start" ></i> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class=" mt-5 mb-3  d-flex justify-content-center">
                                        <button class="btn  btn-danger  text-white fw-bold px-5" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </main>
    </div>

    <?php include_once("./footer.php") ?>




    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>