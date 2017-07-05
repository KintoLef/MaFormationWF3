<?php
require("inc/init.inc.php");

$erreur = '';

// vider le panier
if(isset($_GET['action']) && $_GET['action'] == 'vider')
{
	unset($_SESSION['panier']); // permet de supprimer la partie panier de la session
}

// création du panier
creation_panier();

if(isset($_POST['ajout_panier']))
{
	// si l'indice existe dans post alors l'utilisateur a cliqué sur le bouton ajouter au panier (depuis la page fiche_article.php)
	$info_article = $pdo->prepare("SELECT * FROM article WHERE id_article = :id_article");
	$info_article->bindParam(":id_article", $_POST['id_article'], PDO::PARAM_STR);
	$info_article->execute();
	
	$article = $info_article->fetch(PDO::FETCH_ASSOC);
	
	// ajout de la tva sur le prix
	$article['prix'] = $article['prix'] * 1.2;

	// on ajoute l'article dans le panier via cette fonction (voir dans function.inc.php)
	ajouter_un_article_au_panier($_POST['id_article'], $article['prix'], $_POST['quantite'], $article['titre'], $article['photo']);

	// on redirige sur la même page pour perdre les informations dans POST afin que si l'utilisateur actualise la page (F5) l'article ne soit pas rentré une nouvelle fois
	header("location:panier.php");
	
}

// retirer un article du panier
if(isset($_GET['action']) && $_GET['action'] == 'retirer' && !empty($_GET['id_article']))
{
	retirer_article_du_panier($_GET['id_article']);
}


// VALIDATION DU PAIEMENT DU PANIER
if(isset($_GET['action']) && $_GET['action'] == 'payer' && !empty($_SESSION['panier']['titre']))
{
	// si l'utilisateur clic sur le bouton payer
	// 1ère action: vérification du stock disponible en comparaison des quantités demandées.
	

	for($i=0; $i<count($_SESSION['panier']['titre']); $i++)
	{
		$resultat = $pdo->query("SELECT * FROM article WHERE id_article = " . $_SESSION['panier']['id_article'][$i]);
		$verif_stock = $resultat->fetch(PDO::FETCH_ASSOC);

		if($verif_stock['stock'] < $_SESSION['panier']['quantite'][$i])
		{
			// si on rentre dans cette condition alors il y a un stock inférieur à la quantité demandée
			// 2 possibilités: stock à 0 ou stock > 0 mais < à la quantité demandée
			if($verif_stock['stock'] > 0)
			{
				// il reste du stock alors on affecte directement le stock restant pour la quantité demandée
				$_SESSION['panier']['quantite'][$i] = $verif_stock['stock'];
				$message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la quantité de l\'article' . $_SESSION['panier']['titre'][$i] . ' a été modifiée car notre stock est insuffisant: <br> Veuillez vérifier votre commande</div>';
			}
			else
			{
				$message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la quantité de l\'article' . $_SESSION['panier']['titre'][$i] . ' a été supprimée car nous sommes en rupture de stock pour ce produit !<br> Veuillez vérifier votre commande</div>';
				// si le stock est à 0 alors on enlève l'article du panier
				retirer_article_du_panier($_SESSION['panier']['id_article'][$i]);				
				$i--; // si nous enlevons un article du panier, il est nécéssaire de décrémenter (-1) la variable $i car avec array_splice (voir retirer_article_du_panier() sur function.inc.php) les articles sont réordonnés.
			}

			$erreur = true;
		}
	}

	if(!$erreur) // ou if($erreur != true)
	{
		$id_membre = $_SESSION['utilisateur']['id_membre'];
		$montant_commande = montant_total();
		$pdo->query("INSERT INTO commande (id_membre, montant, date) VALUES ($id_membre, $montant_commande, NOW())");
		$id_commande = $pdo->lastInsertId(); // on récupère l'id inséré par la dernière requête
		$nb_tout_panier = count($_SESSION['panier']['titre']);

		for($i=0; $i<$nb_tout_panier; $i++)
		{
			$id_article_commande = $_SESSION['panier']['id_article'][$i];
			$quantite_commande = $_SESSION['panier']['quantite'][$i];
			$prix_comande = $_SESSION['panier']['prix'][$i];

			$pdo->query("INSERT INTO details_commande (id_commande, id_article, quantite, prix) VALUES ($id_commande, $id_article_commande, $quantite_commande, $prix_comande)");

			// mise à jour du stock
			$pdo->query("UPDATE article SET stock = stock - $quantite_commande WHERE id_article = $id_article_commande");
		}
		unset($_SESSION['panier']);
	}
}

// la ligne suivant commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
// echo '<pre>'; var_dump($_POST); echo '</pre>';
// echo '<pre>'; print_r($_SESSION); echo '</pre>';
?>

    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-shopping-cart" style="color: NavajoWhite;"></span> Panier</h1>
        <?php // echo $message; // messages destinés à l'utilisateur ?>
		<?= $message; // cette balise php inclue un echo // cette ligne php est equivalente à la ligne au dessus. ?>
      </div>
	  
	  <div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<table class="table table-bordered" style="background: rgba(255, 255, 255, 0.7);">
				<tr>
					<th colspan="5">Votre Panier</th>
				</tr>
				<tr>
					<th>Article</th>
					<th>titre</th>
					<th>quantité</th>
					<th>prix unitaire</th>			
					<th>prix total</th>			
					<th></th>
				</tr>
				<?php 
					// vérification si le panier est vide sur n'importe quel tableau array dernier niveau (id_article / prix / quantite ou titre)
					if(empty($_SESSION['panier']['id_article']))
					{
						echo '<tr><th colspan="5" style="color: red; text-align: center;">Aucun article dans votre panier</th></tr>';
					}
					else {
						// sinon on affiche tous les produits dans un  tableau html
						$taille_tableau = count($_SESSION['panier']['titre']);
						for($i = 0; $i < $taille_tableau; $i++)
						{
							echo '<tr>';
							echo '<td><img src="' . URL . 'photo/' . $_SESSION['panier']['photo'][$i] . '" width="50"/></td>';
							echo '<td>' . $_SESSION['panier']['titre'][$i] . '</td>';
							echo '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
							echo '<td>' . number_format($_SESSION['panier']['prix'][$i], 2, ',', ' ') . ' €</td>';
							echo '<td>' . number_format($_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i], 2, ',', ' ') . ' €</td>';
							echo '<td style="padding: 10px;"><a onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cet article\'));" href="?action=retirer&id_article=' . $_SESSION['panier']['id_article'][$i] . '" class="btn btn-danger" style="margin-left: 30px;"><span class="glyphicon glyphicon-remove"></span></a></td>';
							echo '</tr>';
						}

						// rajouter une ligne pour afficher le prix total du panier.
						echo '<tr>
								<td colspan="4">Montant Total TTC</td>
								<td colspan="1"><b>' . number_format(montant_total(), 2, ',', ' ') . ' €</b></td>
							  </tr>';

						// rajouter une ligne du tableau qui affiche un lien a href (?action=payer) pour payer le panier si l'utilisateur est connecté. Sinon afficher un texte pour proposer à l'utilisateur de s'inscrire ou de se connecter
						if(utilisateur_connecte())
						{
							echo '<tr><td colspan="3"><a href="?action=payer" class="btn btn-success form-control">Payer ma Commande</a></td>';
						}
						else
						{
							echo '<tr><td colspan="6">Afin de valider votre commande, veuillez vous <a href="connexion.php">connecter</a>, ou vous <a href="inscription.php">inscrire</a></td></tr>';
						}

						// rajouter une ligne du tableau qui affiche un bouton vider le panier uniquement si le panier n'est pas vide. Et faire le traitement afin que si on clic sur le bouton, il faut vider le panier. (unset($_SESSION['panier']))
						
						echo '<td colspan="3"><a href="?action=vider" class="btn btn-danger form-control">Vider le panier</a></td></tr>';
					}
									
				?>
			</table><br>
			<a href="boutique.php" class="btn btn-success form-control">Retour à la boutique</a>
			<hr />
			<p>Réglement par chèque uniquement !!<br />A l'adresse: 18 avenue Geoffroy L'Asnier 75004 Paris</p>
			<hr />
			<p>
			<?php
			if(utilisateur_connecte())
			{
				// si l'utilisateur est connecté, on affiche son adresse de livraison
				echo '<address><b>Votre adresse de livraison est: </b><br />' . $_SESSION['utilisateur']['adresse'] . '<br />' . $_SESSION['utilisateur']['cp'] . '<br />' . $_SESSION['utilisateur']['ville'] . '</address>';
			}

			?>
			</p>
		</div>
	  </div>
	  

    </div><!-- /.container -->
	
<?php
require("inc/footer.inc.php");

















