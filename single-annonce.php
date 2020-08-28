<?php
    $page = 'single-annonce';
    require 'inc/connect.php';
    require('inc/functions.php');
    $id = $_GET['id'];
    $user_id = $_SESSION['id'];
    require('assets/head.php');
    include('assets/nav.php');
?>

<section class="my-2">
    <div class="container">
        <?= displaySingleAnnonce($id); // Exécution de la fonction définie plus haut dans 'functions.php'?>
    </div>
</section>













<?php require('assets/footer.php');
