<?php
    $page='index';
    require ('inc/connect.php');


?>
<?php
require('assets/head.php');
include('assets/nav.php'); 
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron jumbotron-fluid col-md-12 text-center my-4">
                    <h1 class="display-4">Bienvenue sur Stuliday !</h1>
                    <?php if(empty($_SESSION)){ ?> <p class="lead"> <br> <a href ='login.php'> Connectez-vous </a>ou<a href ='login.php'> Inscrivez-vous</a></p> <?php } ?>
                    <hr class="my-4">
                </div>
        </div>
    </div>
</section>
<?php require('assets/footer.php'); ?>