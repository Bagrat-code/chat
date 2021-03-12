<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Discussion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    



        <h1> Bienvenue sur ce chat !</h1>

	<form method="POST" action="connection_bdd.php">
	    Pseudo : <input type="text" name="pseudo" id="pseudo" /><br />
	    Message : <textarea name="message" id="message"></textarea><br />
	    <input type="submit" name="submit" value="Envoyez votre message !" id="envoi" />
	</form>



</body>
</html>


<?php

// on se connecte à notre base de données
try
{
    $bdd = new PDO("mysql:host=109.234.161.110;dbname=raem3615_bgrigorian", "raem3615_bgrigorian", "c^eFucP)F[f]"); 
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->exec('SET NAMES utf8');
}
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }

    $pseudo =  addslashes($_POST['pseudo']);
    
    
    $message = addslashes($_POST['message']);

    
    // On insère dans la table " conversation " les valeurs des inputs " pseudo " et " message "

    $sql = "INSERT INTO conversation(user, message) 
          VALUES ('$pseudo', '$message')";
          header("Location: /chat");

try {
    $bdd->exec($sql);
    
  }

    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }



?>

    <?php

try
{
    $bdd = new PDO("mysql:host=109.234.161.110;dbname=raem3615_bgrigorian", "raem3615_bgrigorian", "c^eFucP)F[f]"); 
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->exec('SET NAMES utf8');
}
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }

$reponse = $bdd->query('SELECT user, message FROM conversation ORDER BY ID DESC');

    while ($donnees = $reponse->fetch())
{
	echo '<p><strong>' . htmlspecialchars($donnees['user']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
}

$reponse->closeCursor();

?>
    








    
