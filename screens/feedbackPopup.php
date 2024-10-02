<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Avaliação</title>
    <style>
        .star {
            font-size: 35px; /* Tamanho das estrelas aumentado para 35 pixels */
            color: #808080; /* Cor padrão das estrelas (dourado mais escuro) */
            cursor: pointer;
        }
        .star.selected {
            color: #FFD700; /* Cor quando selecionada (dourado) */
        }
        .form-group {
            margin-top: 20px; /* Aumentado para espaçar o texto de opinião */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#feedbackModal">
        Avaliar
    </button>

    <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Avalie sua experiência</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
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
