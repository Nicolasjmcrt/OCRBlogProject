<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-bg">
  			<a class="navbar-brand navbar-title" href="#">Coyo<span>Tech</span></a>
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
  			</button>
  			<div class="collapse navbar-collapse admin-nav-div" id="navbarNavDropdown">
    			<ul class="navbar-nav">
      				<li class="nav-item active">
        				<a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
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