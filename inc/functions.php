<?php

    function random_images($h,$w){
        echo "https://loremflickr.com/$h/$w/houses,cottage";
    }

    function shorten_text($text, $max = 120, $append = '&hellip;'){
        if (strlen($text)<=$max) return $text;
        $return = substr($text,0,$max);
        if (strpos($text,' ')===false) return $return . $append;
        return preg_replace('/\w+$/', '', $return) . $append;
    }

    function displayAllUsers(){
        global $db;
        $sql = $db->query("SELECT * FROM users");
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sql->fetch()){
        ?>
            <div class = "col-4">
                <div class="card p-3">
                    <h2>User n°<?= $row ['id'] ;?></h2>
                    <p><?= $row['email'] ;?></p>
                </div>
            </div>
        <?php 
        }
    }