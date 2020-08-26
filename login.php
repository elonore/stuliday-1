<?php 
    $page ='login';
    require('inc/connect.php');
    require('assets/head.php');
    include('assets/nav.php');

    if (isset($_POST['submit-signup'])){
        $user_email = htmlspecialchars($_POST['user_email_signup']);
        $user_pass = htmlspecialchars($_POST['user_password_signup']);
        $user_pass2 = htmlspecialchars($_POST['user_password_2_signup']);

        if($sql = $db->query("SELECT * FROM users WHERE email = '$user_email'")){
            $compteur = $sql->rowCount();
            if($compteur != 0){
                $message = "<div class ='alert alert-danger'> Il y a déja un compte possédant cet e-mail </div>";
            }elseif(!empty($user_email) && !empty($user_pass)){
                if($user_pass == $user_pass2){
                    $user_pass = password_hash($user_pass, PASSWORD_DEFAULT);
                    $sth = $db->prepare("INSERT INTO users (email, password) VALUES (:email,:password)");

                    $sth->bindValue(':email',$user_email);
                    $sth->bindValue(':password',$user_pass);

                    if($sth->execute()){
                        $message = "<div class ='alert alert-success'> Votre compte a bien été crée </div>";
                    }
                }else{
                    $message = "<div class ='alert alert-danger'> Les mots de passes ne concordent pas </div>";
                }
            }else{
                $message = "<div class ='alert alert-danger'> Veuillez remplir les champs correspondants </div>";
            }
    }else{
        $message = "<div class ='alert alert-danger'> Une erreur vient de se produire.</div>";
    }
}elseif(isset($_POST['submit-login'])){
    $user_email = htmlspecialchars($_POST['user_email']);
    $user_pass = htmlspecialchars($_POST['user_password']);
    $sql = $db->query("SELECT * FROM users WHERE email = '$user_email'");
    if($row = $sql->fetch()){
            $db_id = $row['id'];
            $db_email = $row['email'];
            $db_pass = $row['password'];
        if(password_verify($user_pass,$db_pass)){
            $_SESSION['id'] = $db_id;
            $_SESSION['email'] = $db_email;
            
            $message = "<div class ='alert alert-success'> Vous êtes bien connectés </div>";
        }else{
            $message = "<div class ='alert alert-danger'> Mot de passe incorrect.</div>";
        }
    }else{
        $message = "<div class ='alert alert-danger'> Identifiant inconnu.</div>";
    }
}





?>
<section>
    <div class="container">
        <div class="row">
            <?php if (isset($message)){
                echo "<div class='col-12'> ".$message." </div>";
            } ?>
            <div class="col-md-6">
                <h1>Se connecter</h1>
                
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group col-md-10">
                        <label for="exampleInputEmail1">Adresse e-mail</label>
                        <input type="text" name="user_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre mail...">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group col-md-10">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="user_password" class="form-control" id="exampleInputPassword1" placeholder="Entrez votre mot de passe...">
                    </div>
                    <button type="submit" name="submit-login" class="btn btn-primary col-md-4 offset-3">Connexion</button>
                </form>
            </div>
            <div class="col-md-6">
            <h1>S'inscrire</h1>
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group col-md-10">
                        <label for="exampleInputEmail2">Adresse e-mail</label>
                        <input type="text" name="user_email_signup" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Entrez votre mail...">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group col-md-10">
                        <label for="exampleInputPassword2">Select a Password</label>
                        <input type="password" name="user_password_signup" class="form-control" id="exampleInputPassword2" placeholder="Entrez votre mot de passe...">
                    </div>
                    <div class="form-group col-md-10">
                        <label for="exampleInputPassword3">Re-type your Password</label>
                        <input type="password" name="user_password_2_signup" class="form-control" id="exampleInputPassword3" placeholder="Password">
                    </div>
                    <button type="submit" name="submit-signup" class="btn btn-primary col-md-4 offset-3">Inscription</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php 
    require('assets/footer.php');
?>