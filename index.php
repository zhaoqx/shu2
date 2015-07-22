    <?php 
        require_once ("Includes/simplecms-config.php"); 
        require_once  ("Includes/connectDB.php");
        include("Includes/header.php");         
     ?>


    <div id="main">
    <h3>欢迎使用</h3>

    <ol class="round">
        <li class="one">
            <h5>Sale </h5>
            <a href="/Sale/sale.php"> 出售图书 </a>
        </li>
        <li class="two">
            <h5>Buy</h5>
            <a href="/Sale/buy.php"> 购买图书 </a>
         </li>
        <li class="asterisk">
            <?php
               if (logged_on()) {
            ?>
                <div class="invite">
                    To Invite friends: <a href="invite.php"> Invite </a>. 
                </div>
            <?php
               } 
            ?>
         </li>
    </ol>
    </div>

</div> <!-- End of outer-wrapper which opens in header.php -->

<?php 
    include ("Includes/footer.php");
 ?>