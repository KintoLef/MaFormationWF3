<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Quentin Lefevre">

    <title>Formulaire POST</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Style CSS -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

<?php

echo '<pre>'; print_r($_POST); echo '</pre>';

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['cp']) && isset($_POST['sexe']) && isset($_POST['description']))
    {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $cp = $_POST['cp'];
        $sexe = $_POST['sexe'];
        $description = $_POST['description'];
        
        echo "Votre nom est: " . $nom . "<br />";
        echo "Votre prénom est: " . $prenom . "<br />";
        echo "Vous habitez au: " . $adresse . ' ' . $cp . ' ' . $ville . "<br />";
        echo "Vous êtes un(e): " . $sexe . "<br />";
        echo "Votre description: " . $description . "<br />";
    }



?>

    <div class="container">

        <div class="starter-template">
        <h1>EX 1 - Formulaire POST</h1>
        </div>

        <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form action="" method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" id="adresse" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" name="ville" id="ville" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="cp">Code Postal</label>
                    <input type="text" name="cp" id="cp" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="sexe">Sexe</label>
                    <select id="sexe" name="sexe" class="form-control">
                        <option value="Homme" selected>Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button class="form-control btn btn-success">Envoi</button>
                </div>
            </form>
        </div>
        </div>






    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>