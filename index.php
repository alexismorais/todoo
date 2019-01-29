<?php

function base()
 {
 $dbhost = "localhost";
 $dbuser = "test";
 $dbpass = "123";
 $db = "todoo";
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $dbuser, $dbpass);
	}
	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
	}
	if (isset($_GET["id"])){
		$bdd->query("DELETE FROM liste WHERE id=".$_GET["id"]."");
	}
	
	if (isset($_POST["tache"])){
		$message = $_POST['tache'];
		$bdd->query("INSERT INTO liste (tache) VALUES ('".$message."')");
	}
	
	$reponse = $bdd->query('SELECT * FROM liste');
	
	while ($donnees = $reponse->fetch())
	{
		echo "<li><a id=\"croix\" href=\"index.php?id=".$donnees['id']."\">x</a>   ".$donnees['tache']."</li><br/>";
	}
}
?>

<html>
	<head>
		<style>
			#croix{
				color:white;
				text-decoration:none;
				right:5%;
				background-color:red;
				padding-right:5px;
				padding-left:5px;
			}
			ul{
				list-style:none;
			}
		</style>
	</head>
	<body> 
		<h1>TODOO</h1>
		<form action="index.php" method="post">
					 <input type="text" name="tache"/>
					 <input type="submit" value="Ajouter">
		</form>
		<p>
			<ul>
			<?php
			base();

			?>
			</ul>
		</p>
	</body>
</html>

