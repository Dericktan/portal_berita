<?php
    include 'base.php';


    $cssPath = $baseUrl."assets/css";
    $jsPath = $baseUrl."assets/js";
    $imagePath = $baseUrl."assets/images";

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "portal_berita";
    // $servername = "127.0.0.1";
    // $username = "utemwebi_1731032";
    // $password = "derick1731032";
    // $dbname = "utemwebi_1731032";

    // crearte connection
    $connect = new Mysqli($servername, $username, $password, $dbname);

    // check connection
    if($connect->connect_error) {
        
        die("Connection Failed : " . mysqli_connect_error());
    } else {
        // echo "Successfully Connected";	
    }

?>