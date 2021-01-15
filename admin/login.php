<?php

require_once('includes/crypt.php');
require_once('model/Connect.php');

ini_set('session.use_only_cookies',1);
ini_set("session.cookie_httponly", 1);
session_name('Administration-Blog-CoyoTech');
session_cache_expire(15);
session_start();
session_regenerate_id();



$msg='';
$msgb='';
$envoi='non';

/*En appuyant sur le bouton se connecter, on lance une requète dans la bdd*/
if(isset($_POST['btn'])){

	$vlogin=$_POST['login'];
	$vpass=$_POST['password'];


	$sql="SELECT * FROM user WHERE login=:blogin AND active_account=1 LIMIT 0,1";
	$res = $bdd->prepare($sql);
	$res->bindValue('blogin', $vlogin, PDO::PARAM_STR);
	$res->execute();
	/*On recherche si les id saisies sont corrects*/
	$totalreponse=$res->rowCount();

	if($totalreponse=1){

	$lg=$res->fetch(PDO::FETCH_ASSOC);
		/*On vérifie l'exactitude du mot de passe*/
		/*Et on autorise la connection en redirigeant vers index.php*/
		if(password_verify($vpass.$vsalage, $lg['password'])){
			$_SESSION['connecte']=$lg['last_name'].' '.$lg['first_name'];
			header("Location: index.php");
		/*sinon message d'erreur*/
		}else{
			$msg="Erreur dans le login ou le mot de passe";
		}


	}else{
		$msg="Erreur dans le login ou le mot de passe";
	}




}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<?php require_once('view/backend/head.php'); ?>
</head>
<body class="bg-body" style="background-image: url(images/admin-bg.png);">
	<header>
		<?php require_once('view/backend/log-header.php'); ?>
  	</header>
  	<div class="container">
  		<div class="row form-row">
  			<div class="col-xs-12 col-md-4 text-center">
  				<?php if($msg!==''){print('<p class="badge badge-danger">'.$msg.'</p>');}?>
  				<form action="index.php" method="post" name="" role="" id="">
  					<div class="input-group mb-3">
  						<div class="input-group-prepend">
    						<span class="input-group-text" id="basic-addon1"><img src="images/user-icon.png" alt=""></span>
  						</div>
  						<input type="text" name="login" id="login" class="form-control" placeholder="Login Utilisateur" aria-label="Username" aria-describedby="basic-addon1">
					</div>
  					<div class="input-group mb-3">
  						<div class="input-group-prepend">
    						<span class="input-group-text" id="basic-addon1"><img src="images/key-icon.png" alt=""></span>
  						</div>
  						<input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" aria-label="Password" aria-describedby="basic-addon1">
					</div>
  					<button type="submit" name="btn" id="btn" class="btn btn-primary btn-login">Se connecter</button>
				</form>
				<!-- Link modal -->
				<a href="#" class="lost-password" data-toggle="modal" data-target="#passwordModal">Mot de passe oublié</a>
  			</div>
  		</div>
  	</div>
  	<footer class="footer mt-auto py-3 bg-footer">
  		<?php require_once('view/backend/footer.php'); ?>
    </footer>


    <!-- Modal -->
	<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
				    <h5 class="modal-title" id="passwordModalLabel">Mot de passe oublié</h5>
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				       	<span aria-hidden="true">&times;</span>
				    </button>
				</div>
				<div class="modal-body">Vous avez oublié votre mot de passe ?<br />Indiquez votre adresse email pour le réinitialiser.
				</div>
				<form class="form-inline my-2 my-lg-0">
      				<input class="form-control mr-sm-2" type="email" placeholder="Adresse email" id="email" name="email" value="">
      				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Réinitialiser</button>
    			</form>
				<div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>