<?php
require("inc/init.inc.php");

$title = "";
$actors = "";
$director = "";
$producer = "";
$year = "";
$lang = "";
$cat = "";
$storyline = "";
$video = "";

// contrôle sur l'existence de tous les champs provenant du formulaire (sauf le bouton de validation)
if(isset($_POST['title']) && isset($_POST['actors']) && isset($_POST['director']) && isset($_POST['producer']) && isset($_POST['year']) && isset($_POST['lang']) && isset($_POST['cat']) && isset($_POST['storyline']) && isset($_POST['video']))
{
    // si le formulaire a été validé, on place dans ces variables les saisies correspondantes
    $title = $_POST['title'];
    $actors = $_POST['actors'];
    $director = $_POST['director'];
    $producer = $_POST['producer'];
    $year = $_POST['year'];
    $lang = $_POST['lang'];
    $cat = $_POST['cat'];
    $storyline = $_POST['storyline'];
    $video = $_POST['video'];

    // variable de contrôle des erreurs
    $erreur = "";

    //*************************************************************************************
    // contrôle sur la taille des champs title, actors, director, producer et storyline****
    //*************************************************************************************
    if(iconv_strlen($title)<5)
    {
        $content = '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du champ title doit avoir 5 caractères minimum</div>';
        $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
    }

    if(iconv_strlen($actors)<5)
    {
        $content .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du champ actors doit avoir 5 caractères minimum</div>';
        $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
    }

    if(iconv_strlen($director)<5)
    {
        $content .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du champ director doit avoir 5 caractères minimum</div>';
        $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
    }

    if(iconv_strlen($producer)<5)
    {
        $content .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du champ producer doit avoir 5 caractères minimum</div>';
        $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
    }

    if(iconv_strlen($storyline)<5)
    {
        $content .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du champ storyline doit avoir 5 caractères minimum</div>';
        $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
    }
    
    //*************************************************************************************
    //                          contrôle sur la validité de l'URL
    //*************************************************************************************
    $website = $_POST["video"];
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
    {
        $content .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, URL invalide</div>';
        $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
    }

    //**************************************************
    //              insertion dans la BDD
    //**************************************************
    if($erreur !== true) // si $erreur est différent de true lors les contrôles préalables sont ok
    {
        $enregistrement = $pdo->prepare("INSERT INTO movies(title, actors, director, producer, year_of_prod, language, category, storyline, video) VALUES(:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video)");
        $enregistrement->bindParam(":title", $title, PDO::PARAM_STR);
        $enregistrement->bindParam(":actors", $actors, PDO::PARAM_STR);
        $enregistrement->bindParam(":director", $director, PDO::PARAM_STR);
        $enregistrement->bindParam(":producer", $producer, PDO::PARAM_STR);
        $enregistrement->bindParam(":year_of_prod", $year, PDO::PARAM_STR);
        $enregistrement->bindParam(":language", $lang, PDO::PARAM_STR);
        $enregistrement->bindParam(":category", $cat, PDO::PARAM_STR);
        $enregistrement->bindParam(":storyline", $storyline, PDO::PARAM_STR);
        $enregistrement->bindParam(":video", $video, PDO::PARAM_STR);
        $enregistrement->execute();

        // on rafraichit la page après l'insertion
        header("location:exercice3_formulaire.php");
    }
}

require("inc/head.inc.php");
// echo '<pre>'; print_r($_POST); echo '</pre>';
?>

   <div class="container">

      <div class="starter-template">
        <h1 style="text-align: center; margin: 50px 0;"><span class="glyphicon glyphicon-film" style="color: #00BA67;"></span> Enregistrer un Film</h1>
        <?= $content; // message destiné à l'utilisateur ?>
      </div>

      <div class="row">
        <div class="col-sm-5 col-sm-offset-3">
          <form class="form-horizontal" method="post" action="">

            <div class="form-group">
              <label for="title" class="col-sm-4 control-label">Title</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="title" id="title" value="<?= $title ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="actors" class="col-sm-4 control-label">Actors</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="actors" id="actors" value="<?= $actors ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="director" class="col-sm-4 control-label">Director</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="director" id="director" value="<?= $director ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="producer" class="col-sm-4 control-label">Producer</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="producer" id="producer" value="<?= $producer ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="year" class="col-sm-4 control-label">Year of Prod</label>
              <div class="col-sm-8">
                <select class="form-control" name="year" id="year">
                  <?php

                    // On définit une boucle qui va partir de l'année en cours via date() et qui va décrémenter à chaque tour (jusqu'à 1970), afin d'afficher nos options définissant l'année de production des différents films
                    for($i=date('Y'); $i>=1970; $i--)
                    {
                    ?>
                    <option <?php if($year == $i) {echo 'selected';}?>> <?php echo $i ?></option>
                    <?php
                    }

                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="lang" class="col-sm-4 control-label">Language</label>
              <div class="col-sm-8">
                <select class="form-control" name="lang" id="lang">
                  <option <?php if($lang == 'English') {echo 'selected';}?>>English</option>
                  <option <?php if($lang == 'French') {echo 'selected';}?>>French</option>
                  <option <?php if($lang == 'Spanish') {echo 'selected';}?>>Spanish</option>
                  <option <?php if($lang == 'Japanese') {echo 'selected';}?>>Japanese</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="cat" class="col-sm-4 control-label">Category</label>
              <div class="col-sm-8">
                <select class="form-control" name="cat" id="cat">
                  <option value="horror" <?php if($cat == 'horror') {echo 'selected';}?>>Horror</option>
                  <option value="comedy" <?php if($cat == 'comedy') {echo 'selected';}?>>Comedy</option>
                  <option value="action" <?php if($cat == 'action') {echo 'selected';}?>>Action</option>
                  <option value="drama" <?php if($cat == 'drama') {echo 'selected';}?>>Drama</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="storyline" class="col-sm-4 control-label">Storyline</label>
              <div class="col-sm-8">
               <textarea class="form-control" name="storyline" id="storyline" cols="41" rows="8" style="resize: none;"><?= $storyline ?></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="video" class="col-sm-4 control-label">Video</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="video" id="video" value="<?= $video ?>">
              </div>
            </div>

            
            <div class="form-group">
              <div class="col-sm-offset-6 col-sm-10">
                <button type="submit" class="btn btn-primary" name="inscription" id="inscription" style="background-color: #00BA67; border: 1px solid #B21428"><span class="glyphicon glyphicon-pencil"></span> Enregistrer</button>
              </div>
            </div>

          </form>
        </div>
      </div>

    </div><!-- /.container --> 

<?php
require("inc/footer.inc.php");