<?php

require_once('includes/crypt.php');
require_once('includes/securite.php');
require_once('model/Connect.php');

$msg='';
$userInfo['last_name']='';
$userInfo['first_name']='';
$userInfo['login']='';
$userInfo['email']='';
$userInfo['active_account']=1;
$userInfo['role']='Visitor';
$vuserId=0;



if(isset($_GET['puserId'])){
	$verbe='Modifier';
	$vuserId=$_GET['puserId'];
	$req = $bdd->query("SELECT * FROM user WHERE user_id = '".$vuserId."'");
	$userInfo = $req->fetch(PDO::FETCH_ASSOC);
	// echo '<pre>';
	// var_dump($userInfo);
	// exit;
}else if(isset($_POST['puserId'])){
	$verbe='Modifier';
	$vuserId=$_POST['puserId'];
}else{
	$verbe='Ajouter';

}



if($vuserId>0){
  $sqlmaj="SELECT * FROM user WHERE user_id=:buserId LIMIT 0,1";
  $resmaj = $bdd->prepare($sqlmaj);
  $resmaj->bindValue('buserId', $vuserId, PDO::PARAM_STR);
  $resmaj->execute();
  $lgut=$resmaj->fetch(PDO::FETCH_ASSOC);

  $vlastname=$lgut['last_name'];
  $vfirstname=$lgut['first_name'];
  $vlogin=$lgut['login'];
  $vemail=$lgut['email'];
  $vpassword='';
  $vactiveaccount=$lgut['active_account'];
  $vrole=$lgut['role'];
  $vpassold=$lgut['password'];

}



if(isset($_POST['valid-form'])){

  $vlastname=$_POST['flastname'];
  $vfirstname=$_POST['ffirstname'];
  $vlogin=$_POST['flogin'];
  $vemail=$_POST['femail'];
  $vpassword=$_POST['fpassword'];
  $vactiveaccount=$_POST['factiveaccount'];
  $vrole=$_POST['frole'];


  if(empty($vpassword) OR strlen($vpassword)<=5) {
    if(!isset($vpassold)){
    $msg.="Le mot de passe est obligatoire et doit faire au moins 6 caractères.<br>";

    }
  }




  $sqlverif="SELECT * FROM user WHERE login=:blogin AND user_id<>:buserId LIMIT 0,1";
  $resverif = $bdd->prepare($sqlverif);
  $resverif->bindValue('blogin', $vlogin, PDO::PARAM_STR);
  $resverif->bindValue('buserId', $vuserId, PDO::PARAM_STR);
  $resverif->execute();
  $totalv=$resverif->rowCount();

  if($totalv>0){
    $msg.="Ce login est déjà utilisé.<br>";
  }

  $sqlverif="SELECT * FROM user WHERE email=:bemail AND user_id<>:buserId LIMIT 0,1";
  $resverif = $bdd->prepare($sqlverif);
  $resverif->bindValue('bemail', $vemail, PDO::PARAM_STR);
  $resverif->bindValue('buserId', $vuserId, PDO::PARAM_STR);
  $resverif->execute();
  $totalv=$resverif->rowCount();

  if($totalv>0){
    $msg.="Cet email est déjà utilisé.<br>";
  }


  if(empty($msg)){



    if($vuserId==0){

      $vpassword=password_hash($vpassword.$vsalage, PASSWORD_BCRYPT, ["cost" => 9]);

      $sql="INSERT INTO user (last_name, first_name, login, email, password, active_account, role) VALUES (:blastname, :bfirstname, :blogin, :bemail, :bpassword, :bactiveaccount, :brole)";
      $res = $bdd->prepare($sql);
      $res->bindValue('bpassword', $vpassword, PDO::PARAM_STR);
    }else{
      if(!empty($vpassword)) {
        $vpassword=password_hash($vpassword.$vsalage, PASSWORD_BCRYPT, ["cost" => 9]);
        $sql="UPDATE user SET last_name=:blastname, first_name=:bfirstname, login=:blogin, email=:bemail, password=:bpassword, active_account=:bactiveaccount, role=:brole WHERE user_id=:buserId";
        $res = $bdd->prepare($sql);
        $res->bindValue('bpassword', $vpassword, PDO::PARAM_STR);
        $res->bindValue('buserId', $vuserId, PDO::PARAM_INT);
      }else{
        $sql="UPDATE user SET last_name=:blastname, first_name=:bfirstname, login=:blogin, email=:bemail, active_account=:bactiveaccount, role=:brole WHERE user_id=:buserId";
        $res = $bdd->prepare($sql);
        $res->bindValue('buserId', $vuserId, PDO::PARAM_INT);
      }
    }

    $res->bindValue('blastname', $vlastname, PDO::PARAM_STR);
    $res->bindValue('bfirstname', $vfirstname, PDO::PARAM_STR);
    $res->bindValue('blogin', $vlogin, PDO::PARAM_STR);
    $res->bindValue('bemail', $vemail, PDO::PARAM_STR);
    $res->bindValue('bactiveaccount', $vactiveaccount, PDO::PARAM_STR);
    $res->bindValue('brole', $vrole, PDO::PARAM_STR);

    $res->execute();

    header("Location: listUsersView.php");

  }


}



?>





<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blog CoyoTech Admin</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/styles.css" type="text/css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body class="bg-body" style="background-image: url(images/admin-bg.png);">
	<header>
		   <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-bg">
  			<a class="navbar-brand navbar-title" href="#">Coyo<span>Tech</span></a>
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
  			</button>
  			<div class="collapse navbar-collapse admin-nav-div" id="navbarNavDropdown">
    			<ul class="navbar-nav">
      				<li class="nav-item active">
        				<a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
      				</li>
      				<li class="nav-item dropdown">
        				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Articles</a>
        				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          				<a class="dropdown-item" href="#">Ajouter un article</a>
          				<a class="dropdown-item" href="#">Liste des articles</a>
        				</div>
      				</li>
      				<li class="nav-item dropdown">
        				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Commentaires</a>
        				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          				<a class="dropdown-item" href="#">Liste des commentaires</a>
        				</div>
      				</li>
      				<li class="nav-item dropdown">
        				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Utilisateurs</a>
        				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          				<a class="dropdown-item" href="users.php">Ajouter un utilisateur</a>
          				<a class="dropdown-item" href="listUsersView.php">Liste des utilisateurs</a>
        				</div>
      				</li>
    			</ul>
          		<ul class="logout-ul">
            		<li>
              		<a href="login.php"><img src="images/log-out-icon.png" class="logout-icon" alt="Log-out icon" title="Se déconnecter"></a>
            		</li>
            		<li>
              		<p class="connected-user" >Connecté(e) : <?php echo $_SESSION['connecte'];?></p>
            		</li>
          		</ul>
  			</div>
		</nav>
	</header>
	<div class="container-fluid mb-5">
		<h1 class="text-light pt-3 pb-3 shadow"><?php echo $verbe;?> un utilisateur</h1>
		<form method="post" action="users.php" class="pt-3 pb-3" style="background-color: rgba(255, 255, 255, 0.8); padding-left: 10px; padding-right: 10px; border-radius: 10px;">
  			<div class="form-group">
    			<label for="lastname">Nom :</label>
    			<input type="text" class="form-control" name="flastname" id="lastname" placeholder="Nom de l'utilisateur..." autofocus required value="<?= $userInfo['last_name']?>">
  			</div>
  			<div class="form-group">
    			<label for="firstname">Prénom :</label>
    			<input type="text" class="form-control" name="ffirstname" id="firstname" placeholder="Prénom de l'utilisateur..." required value="<?= $userInfo['first_name']?>">
  			</div>
  			<div class="form-group">
    			<label for="login">Login :</label>
    			<input type="email" class="form-control" name="flogin" id="login" placeholder="Login de l'utilisateur..." required value="<?= $userInfo['login']?>">
  			</div>
  			<div class="form-group">
    			<label for="email">Email :</label>
    			<input type="email" class="form-control" name="femail" id="email" placeholder="Email de l'utilisateur..." required value="<?= $userInfo['email']?>">
  			</div>
  			<div class="form-group">
    			<label for="password">Mot de passe :</label>
    			<input type="password" class="form-control" name="fpassword" id="password" placeholder="Mot de passe de l'utilisateur...">
  			</div>
  			<div class="form-group">
  				<p>Rôle : <br />
    			<div class="form-check form-check-inline">
  					<input class="form-check-input" type="radio" name="frole" id="administrator" value="Administrator" <?php if ($userInfo['role']== 'Administrator') echo 'checked' ?>>
  					<label class="form-check-label" for="administrator">Administrateur</label>
				</div>
				<div class="form-check form-check-inline">
  					<input class="form-check-input" type="radio" name="frole" id="author" value="Author" <?php if ($userInfo['role']== 'Author') echo 'checked' ?>>
  					<label class="form-check-label" for="author">Auteur</label>
				</div>
				<div class="form-check form-check-inline">
  					<input class="form-check-input" type="radio" name="frole" id="visitor" value="Visitor" <?php if ($userInfo['role']== 'Visitor') echo 'checked' ?>>
  					<label class="form-check-label" for="visitor">Visiteur enregistré</label>
				</div>
				</p>
  			</div>
  			<div class="form-group">
    			<p>Compte actif : <br />
    			<div class="form-check form-check-inline">
  					<input class="form-check-input" type="radio" name="factiveaccount" id="1" value="1" <?php echo ($userInfo['active_account'])?'checked':''?>>
  					<label class="form-check-label" for="1">Oui</label>
				  </div>
				  <div class="form-check form-check-inline">
  					<input class="form-check-input" type="radio" name="factiveaccount" id="0" value="0" <?php echo ($userInfo['active_account'])?'':'checked'?>>
  					<label class="form-check-label" for="0">Non</label>
				  </div>
				</p>
  			</div>
        <div class="form-group">
          <input type="hidden" name="puserId" value="<?php echo $vuserId;?>">
          <button type="submit" class="btn btn-save" name="valid-form">Enregistrer</button>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a href="listUsersView.php" type="button" class="btn" title="Retour à la liste des utilisateurs"><img class="backto-icon" src="images/backto-icon.png" alt="Icone retour"></a>
          </div>
        </div>
		</form>
	</div>
<footer class="footer mt-auto py-3 bg-footer">
		<div class="container footer-container">
  			<p>Coyo<span>Tech</span></p>
  			<a href="../index.php">Retour sur le site</a>
		</div>
	</footer>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>