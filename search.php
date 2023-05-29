<?php

require_once 'redirect.php';
if (!$username = checkAuth()) {
    header('Location: landing.php');
    exit;
}

?>

<?php

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pass'], $dbconfig['name']);
$username = mysqli_real_escape_string($conn, $username);
$query = "SELECT * FROM users WHERE username = '$username'";
$res = mysqli_query($conn, $query);
$userinfo = mysqli_fetch_assoc($res);

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel='stylesheet' href='./style/home.css'>
    <link rel="stylesheet" href="./style/profile.css">
    <link rel="stylesheet" href="./style/nav.css">
    <link rel="stylesheet" href="./style/posts.css">

    <script src="./scripts/search.js" defer></script>

    <title>Ricerca Posts</title>
</head>

<body>
    <?php require_once 'navbuilder.php'; ?>


    <form id="search_form">
        <input id="search_fieldbox" type="text" placeholder="Vuoi cercare un post di qualcun altro?">
        <input id="search_button" type="submit" value="Trova Posts">
    </form>

    <main class="fixed">
        <section id="feed">
        </section>
    </main>

</body>

</html>