<?php

$title = 'CoyoTech Blog';

 ?>

<div class="container">
	<h1 style="color:#fff; padding-top: 20px;" >Liste des commentaires invalidés</h1>
	<div class="container">
		<div class="row">
			<div class="col table-responsive">
				<table class="table table-dark table-striped table-hover table-sm">
					<thead class="thead-dark">
						<tr>
							<th scope="col" class="text-center">Contenu</th>
              <th scope="col" class="text-center">Date</th>
         			<th scope="col" class="text-center">Validation</th>
              <th scope="col" class="text-center">Article concerné</th>
          		<th scope="col" class="text-center">Modifier</th>
          		<th scope="col" class="text-center">Supprimer</th>
						</tr>
					</thead>

					<?php foreach ($comments as $lg) { ?>
					<tbody class="tbody-dark">
        				<tr>
         					 <td class="text-center"><?php echo $lg['content'];?></td>
         					 <td class="text-center"><?php echo $lg['comment_date'];?></td>
          					<td class="text-center">
            					<span class="badge  <?php echo ($lg['validation'])?'badge-success':'badge-danger'?>"><?php echo ($lg['validation'])?'oui':'non'?></span>
          					</td>
                    <td class="text-center"><?php echo $lg['article_id'];?></td>
          					<td class="text-center">
          					<!--Renvoi vers la page modifier-->
            					<a href="users.php?puserId=<?php echo $lg['comment_id'];?>">	<img src="images/pen.png" style="width: 25px;" alt=""></a>
          					</td>
          					<td class="text-center">
           						<button type="button" class="trash-btn" data-toggle="modal" data-target="#myModal" rel="<?php echo $lg['comment_id'];?>" title="Commentaire n° <?php echo $lg['comment_id'];?>">
           						 	<img src="images/trash.png" style="width: 23px;" alt="">
            					</button>
          					</td>
        				</tr>
        			<!-- fermeture du while -->
        			<?php
					}


					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Création de le "modal" avec Bootstrap -->


<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Supprimer un commentaire ?</h4>
          		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">&times;</span>
          		</button>
        	</div>
        	<div class="modal-body">
          		<p>Voulez vous supprimer le commentaire suivant ?</p>
          		<p class="titre-user"></p>
        	</div>
        	<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          		<!--ajout de la classe btn-url-supp sur le lien du bouton-->
          		<a href="" type="button" class="btn btn-danger btn-url-supp">Supprimer le commentaire</a>
        	</div><!-- /.modal-footer -->
      	</div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->



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


