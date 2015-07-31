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
                echo "添加";
            }

            if (isset($_POST['search']))
            {
                echo "查询豆瓣";
                $ask_douban = curl_init();
                curl_setopt($ask_douban, CURLOPT_URL, 'http://localhost:61737/');
                curl_setopt($ask_douban, CURLOPT_RETURNTRANSFER,1); 
                $c_douban = curl_exec($ask_douban);    
                echo "Re:".$c_douban."E";        
                curl_close($ask_douban);
            }
        ?>
        

        <form action="Sale.php" method="post">
        <ul>
            <li>
                <label>书名或ISBN:</label> 
                <input type="text" name="search_key" value="" id="search_key" />
                <input type="submit" name="search" value="查询" />
            </li>
            <li>
                <label for="content">图书详情:</label>
                <textarea name="content" id="content"></textarea>
                <input type="submit" name="submit" value="添加" />
            </li>
        </ul>
        </form>
    </body>
</html>
