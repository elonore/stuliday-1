<?php 
    $page ='profile';
    require('assets/head.php');
    include('assets/nav.php');
    require('inc/connect.php'); 
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="py-4">Mon profil :</h2>
            </div>
            <div class="col-md-8">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail">Nom</label>
                        <input type="text" class="form-control" name="nom" id="exampleInputEmail"
                            aria-describedby="emailHelp" placeholder="Nom" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Prénom</label>
                        <input type="text" name="prenom" class="form-control" id="exampleInputPassword"
                            placeholder="Prénom" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Adresse </label>
                        <input type="text" class="form-control" name="adress" id="exampleInputEmail"
                            aria-describedby="emailHelp" placeholder="Adresse" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail"
                            aria-describedby="emailHelp" value="">
                    </div>
                    <input type="submit" name="submit_update" class="btn btn-info" value="Mettre à jour">
                </form>
            </div>
            <div class="col-md-4">
                <a href="#" class="btn btn-primary mb-3">Publier une nouvelle annonce</a>
                <a href="#" class="btn btn-primary mb-3 <?php  if($compteur < 1){ echo 'disabled'; } ?>"
                    data-toggle="modal" data-target="#listingAnnonces">Voir mes annonces  <span class="badge badge-primary badge-pill">10</span>
                    </a>
                <a href="#" class="btn btn-primary mb-3 <?php  if($compt < 1){ echo 'disabled'; } ?>"
                    data-toggle="modal" data-target="#listingResa">Voir mes réservations <span class="badge badge-primary badge-pill">5</span></a>
            </div>
            <div class="col-md-12 text-center pt-5 my-2">
                <a class="btn btn-info back" href="annonces.php">Retour aux annonces</a>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="listingResa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog listings" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mes annonces</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<?php require('assets/footer.php'); ?>