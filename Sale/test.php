
<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:61737/");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        this:
        <?php
// create curl resource
        $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:61737/");
curl_setopt($ch, CURLOPT_HEADER, 0);


        // $output contains the output string
        $output = curl_exec($ch);
        print_r($output);
        echo $output;

        // close curl resource to free up system resources
        curl_close($ch);
?>
    </body>
</html>
