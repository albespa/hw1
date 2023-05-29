<?php
require_once 'redirect.php';
if (!checkAuth()) {
    header('Location: landing.php');
    exit;
}
if (!isset($_GET['q'])) {
    echo "Nessun ID";
    exit;
}

//ELIMINAZIONE POST DAL DATABASE
header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pass'], $dbconfig['name']) or die(mysqli_error($conn));
$postId = mysqli_real_escape_string($conn, $_GET['q']);

$query = "DELETE FROM posts WHERE id = " . $postId . " AND author = '" . $_SESSION["id"] . "'";

if (mysqli_query($conn, $query)) $array[] = ['connectionSuccess' => true, 'deletedRows' => mysqli_affected_rows($conn)];
else $array[] = ['deleted' => false];

echo json_encode($array);
mysqli_close($conn);
