<?php
    

    $img_url =  $_GET["image"];
  
    $ch = curl_init($img_url);
    $fp = fopen('./news_images/image.jpg', 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    

    

?>

