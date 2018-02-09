<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Artisterie | Accueil</title>

		<!-- Font Awesome -->
		<link rel="stylesheet" href="./css/font-awesome.min.css">
		<!-- CSS Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!-- Favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
		<link rel="manifest" href="img/site.webmanifest">
		<link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#1dc918">
		<meta name="msapplication-TileColor" content="#202020">
		<meta name="theme-color" content="#202020">
		<!-- Mon CSS -->
		<link rel="stylesheet" href="./css/artisterie.css">
	</head>
	<body>
		<?php 
			$pageActive = "home";

			require "./menu.php";
		?>

		<main id="mainHome">
		    <div class="container-fluid">
		        <!-- Le slider/carousel de bootstrap -->
		        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		            <ol class="carousel-indicators">
		                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
		                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
		                <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
		                <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
		            </ol>
		            <div class="carousel-inner">
		                <div class="carousel-item active">
		                    <img class="d-block w-100" src="img/slider_actu.jpg" alt="slider_actu">
		                    <div class="carousel-caption">
								<h1>l'Artisterie</h1>
							</div>
		                </div>
		                <div class="carousel-item">
		                    <img class="d-block w-100" src="img/Slider - Répétition 2.jpg" alt="slider_rehearsal">
		                    <div class="carousel-caption">
								<h1>l'Artisterie</h1>
							</div>
		                </div>
		                <div class="carousel-item">
		                    <img class="d-block w-100" src="img/slider_equipment.jpg" alt="slider_equipment">
		                    <div class="carousel-caption">
								<h1>l'Artisterie</h1>
							</div>
		                </div>
		                <div class="carousel-item">
		                    <img class="d-block w-100" src="img/slider_activity.jpg" alt="slider_activity">
		                    <div class="carousel-caption">
								<h1>l'Artisterie</h1>
							</div>
		                </div>
		                <div class="carousel-item">
		                    <img class="d-block w-100" src="img/slider_artists.jpg" alt="slider_artists">
		                    <div class="carousel-caption">
								<h1>l'Artisterie</h1>
							</div>
		                </div>
		                <div class="carousel-item">
		                    <img class="d-block w-100" src="img/Slider - Répétition 3.jpg" alt="slider_equipment">
		                    <div class="carousel-caption">
								<h1>l'Artisterie</h1>
							</div>
		                </div>
		                <div class="carousel-item">
		                    <img class="d-block w-100" src="img/Slider - Répétition.jpg" alt="slider_equipment">
		                    <div class="carousel-caption">
								<h1>l'Artisterie</h1>
							</div>
		                </div>
		            </div>
		            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		                <span class="sr-only">Previous</span>
		            </a>
		            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		                <span class="carousel-control-next-icon" aria-hidden="true"></span>
		                <span class="sr-only">Next</span>
		            </a>
		        </div>
		    </div>
		    <div class="container mt-4">
		    	<h2 class="py-4 text-uppercase">Bienvenue à l'Artisterie</h2>
		    	<p class="text-justify">Présentation générale de l'Artisterie </br>
		    	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		    	</br>
		    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		    </div>		    
		    
		</main>
		<?php 
			require "./footer.php";
		?>


		<!-- SCRIPTS JAVASCRIPT -->
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<!-- JavaScript Boostrap et Popper -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<!-- Paroller -->
		<script src="./js/jquery.paroller.min.js"></script>
		<!-- Mon JavaScript -->
		<script src="./js/script.js"></script>
		
	</body>
</html>
