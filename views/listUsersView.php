<?php

require_once('includes/securite.php');
require_once('model/Connect.php');

if(isset($_GET['action']) AND $_GET['action']=='supp'){
  $vuserId=$_GET['fuserId'];

  $sqlu="SELECT * FROM user WHERE user_id=:buserId LIMIT 0,1";
  $resu = $bdd->prepare($sqlu);
  $resu->bindValue('buserId', $vuserId, PDO::PARAM_STR);
  $resu->execute();
  $lgu=$resu->fetch(PDO::FETCH_ASSOC);


  $dqldelete="DELETE FROM user WHERE user_id=:buserId";
  $ressupp = $bdd->prepare($dqldelete);
  $ressupp->bindValue('buserId', $vuserId, PDO::PARAM_STR);
  $ressupp->execute();

}



 $req = $bdd->query('SELECT user_id, last_name, first_name, login, active_account, role FROM user ORDER BY active_account=1 ASC');

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
	<div class="container">
    <h1 style="color: #fff; padding-top: 20px;" >Liste des utilisateurs</h1><br>
<!--"table-striped" = tableau avec alternance dans Bootstrap-->
<div class="container">
  <div class="row">
    <div class="col table-responsive">
      <table class="table table-dark table-striped table-hover table-sm">
      <thead class="thead-dark">
        <tr>
         <th scope="col" class="text-center">Nom</th>
         <th scope="col" class="text-center">Prénom</th>
         <th scope="col" class="text-center">Login</th>
         <th scope="col" class="text-center">Compte actif</th>
         <th scope="col" class="text-center">Rôle</th>
          <th scope="col" class="text-center">Modifier</th>
          <th scope="col" class="text-center">Supprimer</th>
        </tr>
      </thead>
      <!--Remplissage du tableau à l'aide de la bdd-->
      <?php while($lg=$req->fetch()){ ?>
      <tbody class="tbody-dark">
        <tr>
          <td class="text-center"><?php echo $lg['last_name'];?></td>
          <td class="text-center"><?php echo $lg['first_name'];?></td>
          <td class="text-center"><?php echo $lg['login'];?></td>
          <td class="text-center">
            <span class="badge  <?php echo ($lg['active_account'])?'badge-success':'badge-danger'?>"><?php echo ($lg['active_account'])?'oui':'non'?></span>
          </td>
          <td class="text-center"><?php
          if($lg['role']=='Administrator'){
            echo '<span class="badge badge-success">'.$lg['role'].'</span>';
          }elseif($lg['role']=='Author'){
            echo '<span class="badge badge-warning">'.$lg['role'].'</span>';
          }else{
            echo '<span class="badge badge-danger">'.$lg['role'].'</span>';
          }?>
          </td>
          <td class="text-center">
          <!--Renvoi vers la page modifier-->
            <a href="users.php?puserId=<?php echo $lg['user_id'];?>"><img src="images/pen.png" style="width: 25px;" alt=""></a>
          </td>
          <td class="text-center">
            <button type="button" class="trash-btn" data-toggle="modal" data-target="#myModal" rel="<?php echo $lg['user_id'];?>" title="<?php echo $lg['first_name'].' '.$lg['last_name'];?>"><img src="images/trash.png" style="width: 23px;" alt="">
            </button>
          </td>
        </tr>
        <!--fermeture du while-->
        <?php
        }

        $req->closeCursor();

        ?>
      </tbody>
    </table>
    </div>
  </div>
</div>
    
	</div>



  <!--Création de la "modal" à l'aide de Bootstrap-->


  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Supprimer un utilisateur ?</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Voulez vous supprimer l'utilisateur suivant ?</p>
          <p class="titre-user"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <!--ajout de la classe btn-url-supp sur le lien du bouton-->
          <a href="" type="button" class="btn btn-danger btn-url-supp">Supprimer l'utilisateur</a>
        </div><!-- /.modal-footer -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
	<footer class="footer mt-auto py-3 bg-footer">
		<div class="container footer-container">
  			<p>Coyo<span>Tech</span></p>
  			<a href="../index.php">Retour sur le site</a>
		</div>
	</footer>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function(){
    /*fonction au clic de la classe btn-supp*/
      $('.trash-btn').click(function(){
      /*définition de la valeur à supprimer*/
        valsupp=$(this).attr('rel');
        /*défintion du titre*/
        titre=$(this).attr('title');
        /*titre à afficher en "strong" à l'apparition du modal*/
        $('.titre-user').html('<strong>'+titre+'</strong>');
        /*définition de l'url a afficher*/
        url='listUsersView.php?action=supp&fuserId='+valsupp;
        /*quand suppression confirmée, retour à l'url prédéfinie*/
        $('.btn-url-supp').attr('href',url);
      });
    });
  </script>
</body>
</html>