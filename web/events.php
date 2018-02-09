<?php
	// liste des événements
	$json = array();
	 // requête qui récupère les événements
	$requete = "SELECT e.*, l.txtLocalName as localname, l.txtLocalColor as localcolor, g.txtGroupName as groupname FROM t_event e LEFT JOIN t_user u ON u.iduser = e.idUser LEFT JOIN t_group g ON g.idGroup = u.idGroup LEFT JOIN t_local l ON g.idLocal=l.idLocal ORDER BY id";

	 // connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=artisterie', 'root', '');
	} catch(Exception $e) {
		exit('Impossible de se connecter à la base de données.');
	}
	 // exécution de la requête
	$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

	 // envoi du résultat au success
	echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));

?>