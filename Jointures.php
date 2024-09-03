<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manipulation de base de donnees</title>
</head>
<body>
    <?php
     $serveur = "localhost";
     $login = "root";
     $pass =  "dia_yaya";

     try{
     $connexion = new PDO("mysql:host=$serveur;dbname=tachephp", $login, $pass);
     $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $jointure_int = "
    SELECT inc.prenom, com.commentaire 
    FROM incrits AS inc
    LEFT JOIN commentaires AS com
    ON inc.id = com.id_inscrit

    UNION ALL

    SELECT inc.prenom, com.commentaire 
    FROM incrits AS inc
    RIGHT JOIN commentaires AS com
    ON inc.id = com.id_inscrit
    WHERE inc.id IS NULL
   ";
    
    
    //  SELECT prenom FROM incrits
    // UNION ALL
    // SELECT commentaire FROM commentaires
    $requete = $connexion->prepare($jointure_int);
    $requete->execute();

    $resultat = $requete->fetchall();
    echo '<pre>';
    print_r($resultat);
    echo '</pre>';
     }
    

     catch(PDOException $e){
        echo 'Echec de la connexion : ' .$e->getMessage();
     }
    ?>
</body>
</html>