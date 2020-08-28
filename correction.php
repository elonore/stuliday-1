<?php
require 'inc/connect.php';

if (isset($_POST['submit_annonce'])) {
    var_dump($_POST);
    var_dump($_FILES);
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $city = htmlspecialchars($_POST['city']);
    $category = htmlspecialchars($_POST['category']);
    $file=$_FILES['img_url'];
    $address = htmlspecialchars($_POST['address']);
    $price = htmlspecialchars($_POST['price']);
    $user_id = $_SESSION['id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if ($file['size'] <= 1000000) {
        $valid_ext=array('jpg','jpeg','gif', 'png');
        $check_ext = strtolower(substr(strrchr($file['name'], '.'), 1));

        if (in_array($check_ext, $valid_ext)) {
            $imgname         = uniqid() . '_' . $file['name'];
            $upload_dir      = "./assets/uploads/";
            $upload_name     = $upload_dir . $imgname;
            $move_result     = move_uploaded_file($file['tmp_name'], $upload_name);

            if ($move_result) {
                $sth = $db->prepare("INSERT INTO annonces(title,description,city,category,image_url,address_article,price,author_article,start_date,end_date) VALUES (:title,:description,:city,:category,:image_url,:address_article,:price,:author_article,:start_date,:end_date)
                ");
                
                $sth->bindValue(':title', $title);
                $sth->bindValue(':description', $description);
                $sth->bindValue(':city', $city);
                $sth->bindValue(':category', $category);
                $sth->bindValue(':image_url', $imgname);
                $sth->bindValue(':address_article', $address);
                $sth->bindValue(':price', $price);
                $sth->bindValue(':author_article', $user_id);
                $sth->bindValue(':start_date', $start_date);
                $sth->bindValue(':end_date', $end_date);
        
                $sth->execute();
                echo 'Ca a marché !';
            }
        }
    }
}
