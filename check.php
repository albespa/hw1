<?php
//CHECK DATABASE
require_once 'dbconfig.php';

if (isset($_GET["e"])) {

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pass'], $dbconfig['name']);
    $email = mysqli_real_escape_string($conn, $_GET["e"]);
    $query = "SELECT email FROM users WHERE email = '" . $email . "'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));
    mysqli_close($conn);

    exit;
}

if (isset($_GET["u"])) {

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pass'], $dbconfig['name']);
    $user = mysqli_real_escape_string($conn, $_GET["u"]);
    $query = "SELECT username FROM users WHERE username = '" . $user . "'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));
    mysqli_close($conn);
    exit;
}

echo "Non Autorizzato";

?>