<?php
require ('connect.php');
var_dump($_FILES);
if(isset($_POST['submit_annonce']) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['start_date']) && !empty($_POST['end_date']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['price']) && !empty($_POST['category'])){
    $title = htmlspecialchars($_POST['title']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    $category = htmlspecialchars($_POST['category']);
    $user_id = $_SESSION['id'];

    if(empty($_FILES['img_url']['name'])){
        $file='no-img.jpg';

        $sth = $db->prepare("INSERT INTO annonces(title,description,city,category,image_url,address_article,price,author_article,start_date,end_date) VALUES(:title,:description,:city,:category,:image_url,:address_article,:price,:author_article,:start_date,:end_date)");
                
        $sth->bindValue(':title',$title);
        $sth->bindValue(':description',$description);
        $sth->bindValue(':city',$city);
        $sth->bindValue(':category',$category);
        $sth->bindValue(':image_url',$file);
        $sth->bindValue(':address_article',$address);
        $sth->bindValue(':price',$price,PDO::PARAM_INT);
        $sth->bindValue(':author_article',$user_id);
        $sth->bindValue(':start_date',$start_date);
        $sth->bindValue(':end_date',$end_date);

        $sth->execute();
        header('Location: ../profile.php/?a=1');

    }else{
        $file=$_FILES['img_url'];
        
        if($file['size'] <= 1000000){
            $valid_ext = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            $check_ext = strtolower(substr(strrchr($file['name'], '.'),1));
            if (in_array($check_ext, $valid_ext)){
                $dbname         = uniqid() . '_' . $file['name'];
                $upload_dir = "../assets/uploads/";
                $upload_name    = $upload_dir . $dbname;
                $move_result = move_uploaded_file($file['tmp_name'], $upload_name);
                if($move_result){
        
                    $sth = $db->prepare("INSERT INTO annonces(title,description,city,category,image_url,address_article,price,author_article,start_date,end_date) VALUES(:title,:description,:city,:category,:image_url,:address_article,:price,:author_article,:start_date,:end_date)");
                    
                    $sth->bindValue(':title',$title);
                    $sth->bindValue(':description',$description);
                    $sth->bindValue(':city',$city);
                    $sth->bindValue(':category',$category);
                    $sth->bindValue(':image_url',$dbname);
                    $sth->bindValue(':address_article',$address);
                    $sth->bindValue(':price',$price,PDO::PARAM_INT);
                    $sth->bindValue(':author_article',$user_id);
                    $sth->bindValue(':start_date',$start_date);
                    $sth->bindValue(':end_date',$end_date);
    
                    $sth->execute();
                    header('Location: ./profile.php/?a=1');
                }else{
                    header('Location: ./create-annonces.php/?e=4');
                }
            }else{
                header('Location: ./create-annonces.php/?e=3');
            }


        }else{
            header('Location: ../create-annonces.php/?e=2');
        }
                
    }
}else{
    header('Location: ./create-annonces.php/?e=1');
}
    
?>