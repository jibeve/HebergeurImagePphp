<?php

//On verifie si image a bien été reçue

if(isset($_FILES['image']) && $_FILES['image']['error']== 0){

    //On crée une variable error = 1 quand on reçoit une image
    $error = 1;
    //On vérifie si la taille de l'image <= 3Mo
    if($_FILES['image']['size']<=3000000){
        //Extension
        $informationImage = pathinfo($_FILES['image']['name']); //On récupère toutes les infos sur l'image
        $extensionImage = $informationImage['extension']; //On récupère l'index extension depuis le tableau informationImage
        $extensionArray = array('jpg', 'jpeg', 'png', 'gif'); //Extensions que l'on autorise

        //Si l'extension appartient au tableau
        if(in_array($extensionImage, $extensionArray)){

            //On crée une variable pour le chemin de l'image
            $chemin = 'upload/'.time().rand().rand().'.'.$extensionImage;
            move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
            //Si l'envoi est un succés, on modifie la variable
            $error = 0;
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herbergeur d'images</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- HEADER -->
    <header>
        <h2>
        Hébergeur d'images avec Php
        </h2>
    </header>

<!-- HEADER -->


        <?php
            if(isset($error) && $error == 0){ //Si tentative d'upload et  si succés  !
                echo '<div 
                id="presentation-picture">
                <p>Votre image a été téléversée avec succés</p>
                <img src="'.$chemin.'" id="image"/><br>
                <p>Chemin de votre image</p>
                <input type="text" value="http://localhost:8888/Hebergeur_Images/'.$chemin.'"/><br>
                </div>
                ';
            } else if(isset($error) && $error == 1){
                echo '<div style="text-align: center">Votre image ne peut pas être envoyée.Vérifier l\'extension ou la taille de votre fichier</div>';
            };
        ?>

    <div class="container">  
        <form method="post" action="index.php" enctype="multipart/form-data"> 
            <!-- action permet de définir la page cible, ici index.Php -->
            <!-- enctype permet de spécifier que l'on envoie des fichiers.Ce fichier doit être stocké de façon temporaire.Enctype permet au navigateur de réserver de l'espace pour stocké ce fichier-->
            <p>
                <h1>Upload de photos</h1><br>
                <input type="file" name="image" required><br>
                <button type="submit">Téléverser ma photo</button>
            </p>
        </form>
        </div>
    
</body>
</html>