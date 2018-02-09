		<footer id="footerSite" class="mt-5">
			<div class="container-fluid" id="footer">				
				<!-- Attributs data-paroller pour la parallax de l'équalizer-->
				<div id="equalizer_top" data-paroller-factor="0.2" data-paroller-direction="horizontal">		
				</div>

				<?php
				// Connexion à la base de données
				try {
					   $bdd = new PDO('mysql:host=localhost;dbname=artisterie', 'root', '');
				} catch(Exception $e) {
					   exit('Impossible de se connecter à la base de données.');
				}

				// On récupére la citation et l'auteur de la table t_quote en ne récupérant qu'une seule ligne de la bdd aléatoirement
				$reponse = $bdd->query('SELECT txtQuote,txtAuthor FROM t_quote ORDER BY RAND() LIMIT 1');                                

				// On affiche le resultat
				$donnees = $reponse->fetch();
				?>

				<p class="text-center"><?php echo $donnees['txtQuote']; ?></p>
				
				<!-- Si l'auteur n'est pas vide alors on affiche le <p> correspondant-->
				<?php if (!empty($donnees['txtAuthor'])){
				?>
				<p class="text-center font-italic">- <?php echo $donnees['txtAuthor']; ?> -</p>
				<?php
				} ?>
				<div id="equalizer_bot" data-paroller-factor="0.2" data-paroller-direction="horizontal">
				</div>
				<div class="container">
					<div class="row">
						<div class="col-12 text-center col-md-3 mt-3">
							<ul>
		                        <li><a href="home.php">L'Artisterie</a></li>
		                        <li><a href="studio.php">Studio</a></li>                    
		                        <li><a href="rehearsal.php">Répétitions</a></li>                    
		                        <li><a href="artists.php">Artistes</a></li>                    
		                        <li><a href="news.php">Actus</a></li>
		                    </ul>
						</div>
						<div class="col-12 text-center col-md-3 mt-3">
							<ul>
		                        <li><a href="#">Plan du site</a></li>
		                        <li><a href="#">Mentions légales</a></li>           
		                    </ul>
						</div>
						<div class="col-12 text-center col-md-3 separate mt-4">
							<ul class="links">		                                                           
		                        <li><a href="https://soundcloud.com/"><img id="social_1" src="img/soundcloud_grey.png" alt="soundcloud"></a></li>
		                        <li><a href="https://www.youtube.com/"><img id="social_2" src="img/youtube_grey.png" alt="youtube"></a></li> 
		                        <li><a href="https://www.facebook.com/"><img id="social_3" src="img/fb_grey.png" alt="facebook"></a></li>                  
		                    </ul>
						</div>
						<div class="col-12 text-center col-md-3 mt-3">
							<ul>
		                        <li class="mb-3">Contact Information</li>
		                        <li>185 rue Jean Voillot 69100 Villeurbanne</li></br></li>
		                        <li>0102030405</li>
		                        <li><a href="">email@gmail.com</a></li>
		                    </ul>
		                    <a id="btnContact" href="contact.php" class="btn btn-dark my-3">Plus d'infos</a>
						</div>
					</div>
					<div class="row">
						<p class="col-12 text-center col-md-9 text-center font-italic">&copy; L'Artisterie 2018</p>
					</div>					
				</div>
			</div>			
		</footer>
