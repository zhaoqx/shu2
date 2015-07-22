<?php
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php"); 
    require_once ("Includes/connectDB.php");

    function make_invite_code() {    
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';    
        $rand = $code[rand(0,25)]    
            .strtoupper(dechex(date('m')))    
            .date('d').substr(time(),-5)    
            .substr(microtime(),2,5)    
            .sprintf('%02d',rand(0,99));    
        for(    
            $a = md5( $rand, true ),    
            $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',    
            $d = '',    
            $f = 0;    
            $f < 8;    
            $g = ord( $a[ $f ] ),    
            $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],    
            $f++    
        );    
        return $d;    
    }
    
    
    function insert_invite($invite_code, $old_user) {
        $query = "INSERT INTO invite_code (invite_code, old_user, status) VALUES (?, ?, ?)";

        global $databaseConnection;
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ssi', $invite_code, $old_user, $invite_status);
        $invite_status = 0;
        $statement->execute();
        $statement->store_result();

        if ($statement->error)
        {
            die('insert invite failed: ' . $statement->error);
        }
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
           $invite_code = make_invite_code();
           echo $invite_code;
           insert_invite($invite_code, $_SESSION['username']);
        ?>
        <a href="index.php">返回</a>
    </body>
</html>
