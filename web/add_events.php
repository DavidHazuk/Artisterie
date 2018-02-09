<?php


	if(!empty($_POST['title'])){
		$title=$_POST['title'];
		$start=$_POST['start'];
		$end=$_POST['end'];
	}

	// connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=artisterie', 'root', '');
	} catch(Exception $e) {
		exit('Impossible de se connecter à la base de données.');
	}

	$sql = "INSERT INTO t_event(title, start, end) VALUES (:title, :start, :end)";
	$q = $bdd->prepare($sql);
	$q->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end));
	
?>