<?php
require_once 'redirect.php';
if (!$username = checkAuth()) {
    header('Location: landing.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./style/nav.css">
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="./style/posts.css">
    <script src="./scripts/profile.js" defer></script>
    <title><?php
            echo $_SESSION['username'] . "'s profile";
            ?></title>
</head>

<body>
    <?php require_once 'navbuilder.php' ?>

    <main class="fixed">
        <section id="feed">
        </section>
    </main>
</body>

</html>