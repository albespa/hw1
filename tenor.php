<?php

include_once "dbconfig.php";
header('Content-Type: application/json');


if (isset($_GET["q"])) {
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pass'], $dbconfig['name']) or die(mysqli_error($conn));
    $qSearchValue = mysqli_real_escape_string($conn, $_GET["q"]);
    $encoded = urlencode($qSearchValue);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://g.tenor.com/v1/search?&key=LIVDSRZULELA&media_filter=minimal&limit=6&q='.$encoded,
        CURLOPT_RETURNTRANSFER => true, 
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}
