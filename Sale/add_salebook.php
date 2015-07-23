<?php
    require_once("/Includes/session.php");
?>

<!DOCTYPE html>
<html lang="zh_cn">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <?php #print_r($_SESSION['books']); ?>

        <?php
            if (isset($_POST['submit']))
            {
                #$header = array('"Authorization: Bearer 9b5751c513182ec5d205f54f39488c4f',);
                $ask_douban = curl_init();
                #curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ask_douban, CURLOPT_URL, 'http://www.163.com/');
                #curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ask_douban, CURLOPT_RETURNTRANSFER,1); 
                #curl_setopt($ch, CURLOPT_BINARYTRANSFER,TRUE); 
                $c_douban = curl_exec($ask_douban);    
                echo "Re:".$c_douban."E";        
                curl_close($ask_douban);
            }
        ?>
        

        <form action="add_salebook.php" method="post">
        <ul>
            <li>
                <label>书名或ISBN:</label> 
                <input type="text" name="search_key" value="" id="search_key" />
                <input type="submit" name="submit" value="search" />
            </li>
            <li>
                <label for="content">图书详情:</label>
                <textarea name="content" id="content"></textarea>
            </li>
        </ul>
        </form>
    </body>
</html>
