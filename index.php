	<?php
	session_start();
	include_once("./constantes.php");
	include_once('./data/conexao.php');
	$perfil = $_SESSION['perfil'] ?? NULL;
	$logado = $_SESSION['logado'] ?? NULL;
	$nome = $_SESSION['nome'] ?? NULL;
	?>

	<!DOCTYPE html>
	<html lang="pt-br">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Maxwel/malinski/joao">
		<title>Salão de Beleza Senac</title>

		<link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
		<link rel="stylesheet" href="./assets/css/style.css">
		<link rel="stylesheet" href="./assets/css/elementosIndex.css">
	</head>

	<body class="container-fluid d-flex flex-column">
		<div>
			<?php include_once("./screens/header.php"); ?>


			<main>
				<!-- Imagem Parallax -->
				<div class="d-flex align-items-center justify-content-center bg-dark position-relative paralax1">
					<div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center text-white fs-2 fw-bold matte">
						<h1 class="animate__animated animate__backInDown text-center">Bem-vindo ao Salão Senac! <br> Onde Formamos Profissionais</h1>
					</div>
				</div>

				<div class="bg-dark position-relative paralax2">
					<div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center text-white fs-2 fw-bold matte2" style="backdrop-filter: blur(5px);">
						<h2 class="animate__animated animate__backInLeft">Conheça Nossos Serviços Abaixo</h2>
					</div>
				</div>

				<div class="linha-vermelha"></div>
				<!-- terminar o css amanha -->


				<section class="products">
	<div class="product">
		<h1>Cortes</h1>
		<a class="fancy btn btn-primary" href="./screens/agendamento.php">
		<span class="top-key"></span>
		<span class="text">Agendar</span>
		<span class="bottom-key-1"></span>
		<span class="bottom-key-2"></span>
		</a>
	</div>

	<div class="product">
		<h1>Unhas</h1>
		<a class="fancy btn btn-primary" href="./screens/agendamento.php">
		<span class="top-key"></span>
		<span class="text">Agendar</span>
		<span class="bottom-key-1"></span>
		<span class="bottom-key-2"></span>
		</a>
	</div>

	<div class="product">
		<h1>Depilação</h1>
		<a class="fancy btn btn-primary" href="./screens/agendamento.php">
		<span class="top-key"></span>
		<span class="text">Agendar</span>
		<span class="bottom-key-1"></span>
		<span class="bottom-key-2"></span>
		</a>
	</div>
	</section>


				<!-- 
		<section>
		<div class="customer-feedback">
			<div class="container text-center">
				<div class="row">
					<div class="col-sm-offset-2 col-sm-8">
						<div>
							<h2 class="section-title">What Clients Say</h2>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
						<div class="owl-carousel feedback-slider">

						
							<div class="feedback-slider-item">
								<img src="//c2.staticflickr.com/8/7310/buddyicons/24846422@N06_r.jpg" class="center-block img-circle" alt="Customer Feedback">
								<h3 class="customer-name">Lisa Redfern</h3>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable its layout.</p>
								<span class="light-bg customer-rating" data-rating="5">
									5
									<i class="fa fa-star"></i>
								</span>
							</div>
							

							
							<div class="feedback-slider-item">
								<img src="https://i.postimg.cc/ydBjdm20/michael-dam-m-EZ3-Po-FGs-k-unsplash-1.jpg" class="center-block img-circle" alt="Customer Feedback">
								<h3 class="customer-name">Cassi</h3>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable its layout.</p>
								<span class="light-bg customer-rating" data-rating="4">
									4
									<i class="fa fa-star"></i>
								</span>
							</div>
						

						
							<div class="feedback-slider-item">
								<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/451270/profile/profile-80.jpg" class="center-block img-circle" alt="Customer Feedback">
								<h3 class="customer-name">Md Nahidul</h3>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable its layout.</p>
								<span class="light-bg customer-rating" data-rating="5">
									5
									<i class="fa fa-star"></i>
								</span>
							</div>

						</div>

					
						<div class="feedback-slider-thumb hidden-xs">
							<div class="thumb-prev">
								<span>
									<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/451270/profile/profile-80.jpg" alt="Customer Feedback">
								</span>
								<span class="light-bg customer-rating">
									5
									<i class="fa fa-star"></i>
								</span>
							</div>

							<div class="thumb-next">
								<span>
									<img src="https://i.postimg.cc/ydBjdm20/michael-dam-m-EZ3-Po-FGs-k-unsplash-1.jpg" alt="Customer Feedback">
								</span>
								<span class="light-bg customer-rating">
									4
									<i class="fa fa-star"></i>
								</span>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section> -->



				<style>
					* {
						margin: 0;
						padding: 0;
						box-sizing: border-box;
					}

					img {
						max-width: 100%;
					}

					body {
						font-family: "Roboto Slab", serif;
						font-size: 15px;
						line-height: 1.67;
						color: #444;
						padding: 60px 0;
					}

					.section-title {
						font-size: 28px;
						margin-bottom: 20px;
						padding-bottom: 20px;
						font-weight: 400;
						display: inline-block;
						position: relative;
					}

					.section-title:after,
					.section-title:before {
						content: "";
						position: absolute;
						bottom: 0;
					}

					.section-title:after {
						height: 2px;
						background-color: rgba(252, 92, 15, 0.46);
						left: 25%;
						right: 25%;
					}

					.section-title:before {
						width: 15px;
						height: 15px;
						border: 3px solid #fff;
						background-color: #fc5c0f;
						left: 50%;
						transform: translatex(-50%);
						bottom: -6px;
						z-index: 9;
						border-radius: 50%;
					}

					/* CAROUSEL STARTS */
					.customer-feedback .owl-item img {
						width: 85px;
						height: 85px;
					}

					.feedback-slider-item {
						position: relative;
						padding: 60px;
						margin-top: -40px;
					}

					.customer-name {
						margin-top: 15px;
						margin-bottom: 25px;
						font-size: 20px;
						font-weight: 500;
					}

					.feedback-slider-item p {
						line-height: 1.875;
					}

					.customer-rating {
						background-color: #eee;
						border: 3px solid #fff;
						color: rgba(1, 1, 1, 0.702);
						font-weight: 700;
						border-radius: 50%;
						position: absolute;
						width: 47px;
						height: 47px;
						line-height: 44px;
						font-size: 15px;
						right: 0;
						top: 77px;
						text-indent: -3px;
					}

					.thumb-prev .customer-rating {
						top: -20px;
						left: 0;
						right: auto;
					}

					.thumb-next .customer-rating {
						top: -20px;
						right: 0;
					}

					.customer-rating i {
						color: rgb(251, 90, 13);
						position: absolute;
						top: 10px;
						right: 5px;
						font-weight: 600;
						font-size: 12px;
					}

					/* GREY BACKGROUND COLOR OF THE ACTIVE SLIDER */
					.feedback-slider-item:after {
						content: "";
						position: absolute;
						left: 20px;
						right: 20px;
						bottom: 0;
						top: 103px;
						background-color: #f6f6f6;
						border: 1px solid rgba(251, 90, 13, 0.1);
						border-radius: 10px;
						z-index: -1;
					}

					.thumb-prev,
					.thumb-next {
						position: absolute;
						z-index: 99;
						top: 45%;
						width: 98px;
						height: 98px;
						left: -90px;
						cursor: pointer;
						-webkit-transition: all 0.3s;
						transition: all 0.3s;
					}

					.thumb-next {
						left: auto;
						right: -90px;
					}

					.feedback-slider-thumb img {
						width: 100%;
						height: 100%;
						border-radius: 50%;
						overflow: hidden;
					}

					.feedback-slider-thumb:hover {
						opacity: 0.8;
						-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
					}

					.customer-feedback .owl-nav [class*="owl-"] {
						position: relative;
						display: inline-block;
						bottom: 45px;
						transition: all 0.2s ease-in;
					}

					.customer-feedback .owl-nav i {
						background-color: transparent;
						color: rgb(251, 90, 13);
						font-size: 25px;
					}

					.customer-feedback .owl-prev {
						left: -15px;
					}

					.customer-feedback .owl-prev:hover {
						left: -20px;
					}

					.customer-feedback .owl-next {
						right: -15px;
					}

					.customer-feedback .owl-next:hover {
						right: -20px;
					}

					/* DOTS */
					.customer-feedback .owl-dots {
						position: absolute;
						left: 50%;
						transform: translateX(-50%);
						bottom: 35px;
					}

					.customer-feedback .owl-dot {
						display: inline-block;
					}

					.customer-feedback .owl-dots .owl-dot span {
						width: 11px;
						height: 11px;
						margin: 0 5px;
						background: #fff;
						border: 1px solid rgb(251, 90, 13);
						display: block;
						-webkit-backface-visibility: visible;
						-webkit-transition: all 200ms ease;
						transition: all 200ms ease;
						border-radius: 50%;
					}

					.customer-feedback .owl-dots .owl-dot.active span {
						background-color: rgb(251, 90, 13);
					}

					/* RESPONSIVE */
					@media screen and (max-width: 767px) {
						.feedback-slider-item:after {
							left: 30px;
							right: 30px;
						}

						.customer-feedback .owl-nav [class*="owl-"] {
							position: absolute;
							top: 50%;
							transform: translateY(-50%);
							margin-top: 45px;
							bottom: auto;
						}

						.customer-feedback .owl-prev {
							left: 0;
						}

						.customer-feedback .owl-next {
							right: 0;
						}
					}

					/* extra */
					.copyright {
						text-align: center;
						margin-top: 30px;
						font-size: 1.6rem;
						background-color: #ededed;
					}

					.copyright a {
						display: inline-block;
						padding: 15px 2px;
					}

					.copyright a:not(:last-child):after {
						content: "/";
						margin-left: 10px;
					}

					.toptal {
						color: #204ecf;
					}

					.upstack {
						color: #008bf7;
					}

					.upwork {
						color: #37a000;
					}

					.fiverr {
						color: #1dbf73;
					}

					.jobs {
						color: magenta;
						text-decoration: underline;
						margin-top: -15px;
					}




					/* Estilo da .product */
.product {
  position: relative;
  overflow: hidden; /* Impede que o blur ultrapasse os limites do produto */
}

/* Pseudo-elemento para aplicar o blur no fundo */
.product:hover::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: inherit; /* Herda o fundo do produto */
  filter: blur(5px);
  z-index: 1; /* Garante que o desfoque fique atrás do conteúdo */
  transition: filter 0.3s ease;
}

/* Estilo do texto e do botão para que fiquem visíveis sobre o blur */
.product h1, 
.product .fancy {
  position: relative;
  z-index: 2; /* Garante que o texto e o botão fiquem sobre o desfoque */
}

/* Estilo do botão fancy */
.fancy {
  display: none;
  background-color: transparent;
  border: 2px solid #000;
  border-radius: 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  font-weight: 700;
  letter-spacing: 0.05em;
  margin: 0;
  outline: none;
  padding: 1.25em 2em;
  position: relative;
  text-align: center;
  text-decoration: none;
  transition: all 0.3s ease-in-out;
  font-size: 13px;
}

/* Exibindo o botão quando o mouse passa sobre o produto */
.product:hover .fancy {
  display: inline-block; /* Exibe o botão quando o mouse está sobre o produto */
}

/* Efeito hover do botão */
.fancy:hover {
  color: white;
  background: black;
  transition: all 0.3s ease;
}

.fancy:hover::before {
  width: 0.9375rem;
  background: white;
}

.fancy:hover .text {
  color: white;
  padding-left: 1.5em;
}

.fancy:hover .top-key {
  left: -2px;
  width: 0px;
}

.fancy:hover .bottom-key-1,
.fancy:hover .bottom-key-2 {
  right: 0;
  width: 0;
}




				</style>


				<!-- Seção de Agendamento
				<div class="bg-primary text-white py-5 text-center">
					
				</div> -->
			</main>
		</div>
		<div class="linha-vermelha"></div>
		<?php include("./screens/footer.php"); ?>
		<script src="./src/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="./src/js/script.js"></script>
		<script src="./src/magic-master/gulpfile.js"></script>
		<script src="./src/js/index.js"></script>
	</body>

	</html>