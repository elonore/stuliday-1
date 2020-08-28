<?php
$page='create_announce';
require ('inc/connect.php');
$today = date("Y-m-d");
$id = $_SESSION['id'];
require ('inc/functions.php');
?>
<?php
require('assets/head.php');
include('assets/nav.php');
if (isset($_GET['e']) && $_GET['e'] == '1'){
    echo "<div class='col-12 alert alert-danger text-center'> Tous les champs n'ont pas été renseignés. </div>";
}elseif (isset($_GET['e']) && $_GET['e'] == '2'){
    echo "<div class='col-12 alert alert-danger text-center'> Le fichier téléchargé est trop grand (10Mb maximum). </div>";
}elseif (isset($_GET['e']) && $_GET['e'] == '3'){
    echo "<div class='col-12 alert alert-danger text-center'> Le fichier téléchargé est invalide (Seules les images sont acceptées). </div>";
}elseif (isset($_GET['e']) && $_GET['e'] == '4'){
    echo "<div class='col-12 alert alert-danger text-center'> Une erreur est survenue ! </div>";
}





?>
<section class="container py-5">
    <div class="row justify-content-center">
        <h1 class='col-12'>Création de votre annonce</h1>
        <form action="inc/create-annonces-post.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="title_annonce">Titre de votre annonce</label>
                    <input type="text" class="form-control" name="title" id="title_annonce" placeholder="Joli appartement situé en plein centre-ville">
                </div>
                <div class="form-group col-md-6">
                <label for="start_date">Date de début de l'annonce</label>
                <input type="date" class="form-control" name="start_date" id="start_date" min = "<?= $today;?>">
                </div>
                <div class="form-group col-md-6">
                <label for="end_date">Date de fin de l'annonce</label>
                <input type="date" class="form-control" name="end_date" id="end_date" max= "">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="address_annonce">Adresse complète</label>
                    <input type="text" class="form-control" name="address" id="address_annonce" placeholder="Adresse complète avec code postal inclus" class="col-md-12">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                        <label for="desc_annonce">Description de l'annonce</label>
                        <textarea class="form-control" name="description" rows="3" placeholder ="Description détaillée de l'annonce" id="desc_annonce" required></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="city_annonce">Ville</label>
                    <input type="text" class="form-control" name="city" id="city_annonce" placeholder="Adresse complète avec code postal inclus" class="col-md-12">
                </div>
                <div class="form-group col-md-12">
                    <label for="type_announce">Type du logement</label>
                    <select id="type_announce" class="col-md-12" name="category">
                        <option value="Logement Entier">Logement Entier</option>
                        <option value="Chambre privée">Chambre privée</option>
                        <option value="Chambre d'hôtel">Chambre d'hôtel</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                        <label for="price_annonce">Prix par nuit (en €) </label>
                        <input type="number" class="form-control" id="price_annonce" name="price" min ="1" max="999" required>
                </div>
                <div class="form-group">
                    <label for="img_url">Choisissez une photo de présentation</label>
                    <input type="file" name="img_url" id="img_url" accept=".png,.jpeg,.jpg,.gif">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            J'accepte les CGU
                        </label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?= $id; ?>">
            <input type="submit" class="btn btn-primary col-6 offset-md-3" name ="submit_annonce" value="Créer votre annnonce"/>
        </form>
        </div>
</section>
<?php require ('assets/footer.php') ?>