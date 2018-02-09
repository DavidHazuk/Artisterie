<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Artisterie | Contact</title>

		<!-- Font Awesome -->
		<link rel="stylesheet" href="./css/font-awesome.min.css">

		<!-- CSS Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<!-- Mon CSS -->
		<link rel="stylesheet" href="./css/artisterie.css" >
	</head>
	<body>
		<?php 
			$pageActive = "contact";

			require "./menu.php";
		?>

		<main id="mainContact" class="container-fluid">
			<div id="headerContact" class="row flex-column py-4">
				<h2 class="pt-3 text-center">Contact L'Artisterie</h2>
				<p class="p-3 text-center">Appelez-nous au 0612345678</p>
				<p class="pb-3 text-center">Mail test@test.com</p>
			</div>
			<div class="container">
				<div class="row">
					<form method="POST" action="" class="col-12 col-md-8 py-4">
						<legend class="col-12">Formulaire de contact</legend>
						<fieldset class="col-12 d-flex flex-wrap">
							<div class="form-row">
								<div class="form-group col-12">
									<select class="form-control" id="cboTypeDemande" name="cboTypeDemande">
										<option value="0">Type de demande</option>
										<option value="1">Renseignements sur les répétitions</option>
										<option value="2">Devis studio</option>
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-12 col-md-6">
									<input class="form-control" type="text" id="txtFirstName" name="txtFirstName" placeholder="Prénom"/>
								</div>
								<div class="form-group col-12 col-md-6">
									<input class="form-control" type="text" id="txtLastName" name="txtLastName" placeholder="Nom"/>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-12 col-md-4">
									<input class="form-control" type="text" id="txtTel" name="txtTel" placeholder="Téléphone"/>
								</div>
								<div class="form-group col-12 col-md-8">
									<input class="form-control" type="email" id="txtEmail" name="txtEmail" placeholder="Email"/>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-12">
									<textarea class="form-control" id="txtMessage" name="txtMessage" placeholder="Message" rows=8></textarea>
								</div>
							</div>
							<div class="form-row p-1 justify-content-center">
								<button id="btnSubmitContact" name="btnSubmitContact" class="btn btn-primary">Envoyer</button>
							</div>
						</fieldset>
					</form>
					<div class='col-12 col-md-4 p-0'>
						<div id="coordonnees">
							<div id="map"></div>
							<div class="p-3 text-center">
		                        <h3>L'Artisterie</h3>
		                        <p>185 rue Jean Voillot</p>
		                        <p>69100 Villeurbanne</p>
		                        <p>0102030405</p>
		                        <p><a href="">email@gmail.com</a></p>
							</div>
						</div>
					</div>
				</div>
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
		<!-- <script src="./js/script_contact.js"></script> -->

		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlPEbrouPSY0CLRmMv0w-zb3IyrFp853s&callback=initMap"></script>
		<script>
			function initMap() {
				var artisterie = {lat: 45.753112, lng: 4.911909};
				var map = new google.maps.Map(document.getElementById('map'), {	zoom: 5,
					center: artisterie,
					zoom: 16
				});

				var marker = new google.maps.Marker({position: artisterie,
													map: map
													});

				marker.addListener('click', function() {
					infowindow.open(map, marker);
				});				
			}
		</script>

	</body>
</html>
