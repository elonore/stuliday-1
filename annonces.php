<?php 
    $page='annonce';
    require('inc/connect.php');
    require('assets/head.php');
    include('assets/nav.php');
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">    
                <h1>Liste des annonces :</h1>
            </div>
        </div>
        <div class="row">
            <?php
                // Affichages des annonces
            ?>
        </div>
    </div>
</section>
<?php require('assets/footer.php'); ?>