<?php
    require_once("/Includes/session.php");
    
    $books = $_SESSION['books'];
    $_SESSION['books']=$books;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>出售图书</title>
    </head>
    <body>
        <div class="display-list">
            <form action="sale_deal.php" method="post">
            <table border="0" id="sale_books">
            <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Detail</th>
            </tr>
            <?php $i=0; foreach ($books as $row): ?> 
            <tr>          
                <?php foreach ($row as $str): ?> 
                <td><?php echo $str; ?></td> 
                <?php endforeach; ?> 
            </tr> 
            <?php $i++; endforeach; ?>
            <tr>
                <td> <a href="add_salebook.php"> 添加图书 </a> </td>
            </tr>

            </table>
            <input name="sale_books" type="hidden" value="<?php print_r($books) ?>" />           
            <input type="submit" name="submit" value="提交">
            </form>
        </div>
        <div class="display-add">
            <?php 
                include ("add_salebook.php");
            ?>
        </div>
        
    </body>
</html>
