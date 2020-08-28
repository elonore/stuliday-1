<?php
  
    function random_images($h, $w)
    {
        echo "https://loremflickr.com/$h/$w/houses,cottage";
    }

    function shorten_text($text, $max = 60, $append = '&hellip;')
    {
        if (strlen($text)<=$max) {
            return $text;
        }
        $return = substr($text, 0, $max);
        if (strpos($text, ' ')===false) {
            return $return . $append;
        }
        return preg_replace('/\w+$/', '', $return) . $append;
    }

    function displayAllAnnonces()
    {
        global $db;
        $user_id = $_SESSION['id'];
        $sql = $db->query("SELECT * FROM annonces WHERE active > 0 AND author_article NOT IN ($user_id)");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while ($row = $sql->fetch()) {
            ?>
<div class="col-4 card-group">
  <div class="card border-danger m-1 text-center">
    <img class="card-img-top img-fluid"
      src="assets/uploads/<?= $row['image_url']; ?>"
      alt="Card image cap">
    <div class="card-body align-items-center">
      <h5 class="card-title"><?= $row ['title'] ; ?>
      </h5>
      <p class="card-subtitle mb-2 text-muted"> Disponible du <?= date("jS F, Y", strtotime($row['start_date'])); ?>
        Au <?= date("jS F, Y", strtotime($row['end_date'])); ?>
      </p>
      <p><?php echo shorten_text($row['description']); ?>
      </p>
      <p><?php echo $row['price']; ?> €/nuit</p>
    </div>
    <div class="card-footer">
      <a class="btn btn-danger"
        href="single-annonce.php?id=<?= $row['id']; ?>">Voir
        l'annonce</a>
    </div>
  </div>
</div>
<?php
        }
    }

    function displaySingleAnnonce($x)
    {
        global $db;
        $req = $db->query("SELECT * FROM annonces WHERE id = '$x' LIMIT 1");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $row = $req->fetch();
        $active = $row['active'];
        $id = $row['id'];
        $date = date_create_from_format('Y-m-d', $row['start_date']);
        $startdate = date_format($date, 'j/m/Y');
        $date = date_create_from_format('Y-m-d', $row['end_date']);
        $enddate = date_format($date, 'j/m/Y');
        $user_id = $_SESSION['id']; ?>
<div class="annonce row">
  <div class="col-12 text-center">
    <img class="img-fluid"
      src="assets/uploads/<?= $row['image_url']; ?>"
      alt="Card image cap">
  </div>
  <div class="col-8 border border-danger rounded text-center m-2 p-4">
    <h1 class=""><span style="color: Crimson;"><i class="fas fa-house-user"></span></i> <?php echo $row['title']; ?>
    </h1>
    <p><?php echo $row['description']; ?>
    </p>
    <h3>Type du logement : <?php echo $row['category']; ?>
    </h3>
    <p>Adresse : <?php echo $row['address_article']; ?>
    </p>
    <h3>Ville : <?php echo $row['city']; ?>
    </h3>
  </div>
  <div class="col-4 row flex-column my-2">
    <div class="row justify-content-around mx-2">
      <div class="col-5 btn btn-outline-success">
        <p> Du <?php echo $startdate; ?>
        </p>
        <span style="color: lime;font-size:3rem;"><i class="far fa-calendar-check"></i></span>
      </div>
      <div class="col-5 btn btn-outline-danger">
        <p> Au <?php echo $enddate; ?>
        </p>
        <span style="color: darkorange;font-size:3rem;"><i class="far fa-calendar-times"></i></span>
      </div>
    </div>
    <div class="btn btn-outline-danger btn-small my-2">Prix: <?= $row['price']; ?>€ / nuit</div>
    <?php
                if ($active > 0) {
                    ?>
    <button type="button" class="btn btn-lg btn-outline-success" data-toggle="modal" data-target="#reservation">
      Réserver </button>
    <?php
                } else {
                    echo "<button class='btn btn-lg btn-warning'> Plus de places disponibles ! </button>";
                } ?>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="reservation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Réservation d'un séjour</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="reservation.php" method="post">
          <p> Êtes vous sûrs de vouloir réserver cette annonce ? </p>
          <input type="hidden" name="annonce_id" value="<?= $id; ?>">
          <input type="hidden" name="user_id"
            value="<?= $user_id; ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" name="form-reservation" class="btn btn-success">Réserver</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>
<?php
    }
    ?>
<?php 