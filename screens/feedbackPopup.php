<?php
include_once("../constantes.php")
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Avaliação</title>
    
</head>
<body class="d-flex flex-column min-vh-100">
<?php include_once("./header.php"); ?>
<main>
<div class="container mt-5">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#feedbackModal">
        Avaliar
    </button>
    <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Avalie sua experiência</h5>
                </div>
                <div class="modal-body">
                    <h4>Como você avaliaria sua experiência do Senac Salão de Beleza?</h4>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                      <label class="form-check-label" for="flexRadioDefault1">Ruim</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                      <label class="form-check-label" for="flexRadioDefault1">Bom</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                      <label class="form-check-label" for="flexRadioDefault1">Otimo</label>
                    </div>
                    <h4>Qual nota você daria para o aluno que o atendeu?</h4>
                    <div>
                        <span class="star selected" onclick="selectStars(this);">★</span>
                        <span class="star" onclick="selectStars(this);">★</span>
                        <span class="star" onclick="selectStars(this);">★</span>
                        <span class="star" onclick="selectStars(this);">★</span>
                        <span class="star" onclick="selectStars(this);">★</span>
                    </div>
                    <div class="form-group mt-4">
                        <label for="feedbackText">Deixe sua opinião:</label>
                        <textarea class="form-control" id="feedbackText" rows="3" maxlength="300"></textarea>
                        <small class="form-text text-muted">Máximo de 300 caracteres.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("./footer.php"); ?>

</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function selectCircle(selected) {
        const circles = document.querySelectorAll('.circle');
        circles.forEach(circle => {
            circle.classList.remove('selected');
        });
        selected.classList.add('selected');
    }

    function selectStars(selected) {
        const stars = document.querySelectorAll('.star');
        const index = Array.from(stars).indexOf(selected);

        stars.forEach((star, i) => {
            star.classList.toggle('selected', i <= index);
        });
    }
</script>
</body>
</html>
