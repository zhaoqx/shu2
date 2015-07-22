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
        <ul>
            <li>
                <label>书名或ISBN:</label> 
                <input type="text" name="search_key" value="" id="search_key" />
            </li>
            <li>
                <label for="content">图书详情:</label>
                <textarea name="content" id="content"></textarea>
            </li>
        </ul>
    </body>
</html>
