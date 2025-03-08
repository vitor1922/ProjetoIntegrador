	<?php

	include_once("./constantes.php");
	include_once('./data/conexao.php');

	session_start();
	$perfil = $_SESSION['perfil'] ?? NULL;
	$logado = $_SESSION['logado'] ?? NULL;
	$nome = $_SESSION['nome'] ?? NULL;
	?>

	<!DOCTYPE html>
	<html lang="pt-br">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
		<link rel="stylesheet" href="./assets/css/style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
		<title>Salão de Beleza Senac</title>
		<meta name="author" content="Maxwel/malinski/joao/Vitor Baggio">

	</head>

	<body class="container-fluid d-flex flex-column">
		<div>
			<?php include_once("./screens/header.php"); ?>

			<main>
				<!-- FOTOS ESTÃO ANEXADAS NO CSS -->
				<div class="d-flex align-items-center justify-content-center bg-dark position-relative paralax1 index-cavera">
					<div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center text-white fs-2 fw-bold matte">
						<h1 class="animate__animated animate__backInDown text-center">Bem-vindo ao Salão Senac! <br> Onde Formamos Profissionais</h1>
					</div>
				</div>

				<div class="bg-dark position-relative paralax2 index-cavera">
					<div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center text-white fs-2 fw-bold matte2" style="backdrop-filter: blur(5px);">
						<h2 class="animate__animated animate__backInLeft">Conheça Nossos Serviços Abaixo</h2>
					</div>
				</div>

				<div class="linha-vermelha"></div>

				<section class="products">
					<div class="product col-12 col-sm-6 col-md-4">
						<h1>Cortes</h1>
						<a class="fancy btn btn-primary" href="./screens/agendamento.php">
							<span class="text">Agendar</span>
						</a>
					</div>

					<div class="product col-12 col-sm-6 col-md-4">
						<h1>Unhas</h1>
						<a class="fancy btn btn-primary" href="./screens/agendamento.php">
							<span class="text">Agendar</span>
						</a>
					</div>

					<div class="product col-12 col-sm-6 col-md-4">
						<h1>Depilação</h1>
						<a class="fancy btn btn-primary" href="./screens/agendamento.php">
							<span class="text">Agendar</span>
						</a>
					</div>
		</div>
		</section>
		</main>
		</div>
		<?php include("./screens/footer.php"); ?>

		<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

	</body>

	</html>