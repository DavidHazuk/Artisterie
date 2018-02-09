<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Artisterie | Répétitions</title>

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
		<link rel="stylesheet" href="./css/artisterie.css" >
	</head>
	<body>

		<?php
			$pageActive = "rehearsal";
			include "menu.php";
		?>

		<main id="mainRehearsal">

	<!-- 
	####  ##    ##   ########   ########    #######   
	 ##   ###   ##      ##      ##     ##  ##     ##  
	 ##   ####  ##      ##      ##     ##  ##     ##  
	 ##   ## ## ##      ##      ########   ##     ##  
	 ##   ##  ####      ##      ##   ##    ##     ##  
	 ##   ##   ###      ##      ##    ##   ##     ##  
	####  ##    ##      ##      ##     ##   #######   
	 -->
			<br>
			<div class="container-fluid" id="intro">
				<div class="container">
					<div class="row">
						<div class="col-12">
	 						<p class="text-justify">L'Artisterie possède 3 locaux de répétition spacieux, de 29m² à 55 m².Ils sont traités acoustiquement pour que les musiciens puissent répéter dans de bonnes conditions.</p>
							<p class="text-justify">La location se fait au mois, les locaux ne sont pas équipés, mais suffisamment grands pour y entreposer tout le matériel de plusieurs groupes.</p>
							<p class="text-justify">L'accès est libre 24h/24 et 7j/7, les répétitions sont sans restrictions les week-end et jours fériés mais ne sont autorisées qu'à partir de 18h en semaine.</p>
						</div>
					</div>	 
				</div>	 
			</div>	 
			
		<!-- 
		########   ##            ###     ##    ##        
		##     ##  ##           ## ##    ###   ##      
		##     ##  ##          ##   ##   ####  ##        
		########   ##         ##     ##  ## ## ##       
		##         ##         #########  ##  ####     
		##         ##         ##     ##  ##   ###      
		##         ########   ##     ##  ##    ##      
		 -->
			<br>
			<div class="container-fluid dark-bg" id="plan">
				<div class="container">
					<div class="row">
						<div class="col-12">
	 						<h1 class="text-center">PLAN</h1>
	 						<img src="img/rehearsal_plan_1100px.jpg" alt="Plan des locaux de répétition" usemap="plan">
	 						<!-- Img link area map -->
							<map name="plan" id="plan">
							    <area alt="Locaux d'enregistrement" title="Locaux d'enregistrement" href="studio.php" shape="rect" coords="1,75,521,300"/>
							</map>
	 						<br><br><br><br>
						</div>
					</div>	 
				</div>	 
			</div>	


	<!-- 
	########    #######    #######   ##     ##   ######    
	##     ##  ##     ##  ##     ##  ###   ###  ##    ##   
	##     ##  ##     ##  ##     ##  #### ####  ##         
	########   ##     ##  ##     ##  ## ### ##   ######    
	##   ##    ##     ##  ##     ##  ##     ##        ##   
	##    ##   ##     ##  ##     ##  ##     ##  ##    ##   
	##     ##   #######    #######   ##     ##   ######    
	 -->
			<br>	
			<div class="container-fluid" id="rooms">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h1 class="text-center">LOCAUX</h1>
						</div>
					</div>	
					<br>
					<div class="row">
						<div class="col-12 col-md-2 d-flex align-items-center justify-content-center">
							<div class="text-center">
								<h3>Local #1</h3>
								<p>29 m²</p>
							</div>
						</div>	
						<div class="col-12 col-md-10 d-flex align-items-center justify-content-center">
							<img src="img/rehearsal1.jpg" alt="Local 1">
						</div>
					</div>
					<br><br>
					<div class="row">
						<div class="col-12 col-md-2 order-md-last d-flex align-items-center justify-content-center">
							<div>
								<h3>Local #2</h3>
								<p>30 m²</p>
							</div>	
						</div>	
						<div class="col-12 col-md-10 d-flex align-items-center justify-content-center">
							<img src="img/rehearsal2.jpg" alt="Local 1">
						</div>
					</div>
					<br><br>
					<div class="row">
						<div class="col-12 col-md-2 d-flex align-items-center text-center justify-content-center">
							<div>
								<h3>Local #3</h3>
								<p>55 m²</p>
							</div>
						</div>	
						<div class="col-12 col-md-10 d-flex align-items-center justify-content-center">
							<img src="img/rehearsal3.jpg" alt="Local 1">
						</div>
					</div>
					<br>
				</div>	 
			</div>	

		</main>		

		<?php
			include "footer.php";
		?>
	


		<!-- SCRIPTS JAVASCRIPT -->
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<!-- JavaScript Boostrap et Popper -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<!-- Paroller -->
		<script src="./js/jquery.paroller.min.js"></script>
		<!-- Google VR View -->
		<script src="https://storage.googleapis.com/vrview/2.0/build/vrview.min.js"></script>
		<!-- Mon JavaScript -->
		<script src="./js/script.js"></script>
	</body>
</html>