<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop UP</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Filtros
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column">
                    <div class="mb-3">
                        <div class="border border-success rounded-5 p-2 mb-2">
                            <i class="bi bi-arrow-left"></i>
                            Barbearia
                            <i class="bi bi-arrow-right"></i>
                        </div>
                        <a href="" class="d-block mb-1">Cortes Masculinos</a>
                        <a href="" class="d-block mb-1">Barbearia</a>
                    </div>
                    <div class="mb-3">
                        <div class="border border-success rounded-5 p-2 mb-2">
                            <i class="bi bi-arrow-left"></i>
                            Salão De Beleza
                            <i class="bi bi-arrow-right"></i>
                        </div>
                        <a href="" class="d-block mb-1">Processos Capilares</a>
                        <a href="" class="d-block mb-1">Mãos e Pés</a>
                        <a href="" class="d-block mb-1">Cabelo</a>
                    </div>
                    <div class="mb-3">
                        <div class="border border-success rounded-5 p-2 mb-2">
                            <i class="bi bi-arrow-left"></i>
                            Centro de Estetica
                            <i class="bi bi-arrow-right"></i>
                        </div>
                        <a href="" class="d-block mb-1">Estetica Corporal</a>
                        <a href="" class="d-block mb-1">Mãos e Pés</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../src/bootstrap/js/bootstrap.js"></script>
</body>

</html>
