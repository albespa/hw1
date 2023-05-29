<?php
require_once 'redirect.php';
if (!$username = checkAuth()) {
    header('Location: landing.php');
    exit;
}

//INSERIMENTO POST NEL DATABASE
if (!empty($_POST['title']) && !empty($_POST['story'])) {
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pass'], $dbconfig['name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $story = mysqli_real_escape_string($conn, $_POST['story']);
    $tenorURL = mysqli_real_escape_string($conn, $_POST['tenorURL']);

    $id = $_SESSION['id'];

    $query = "INSERT INTO posts(author,title,cap,gif) 
    VALUES ('$id',\"$title\",\"$story\",\"$tenorURL\")";
    if (mysqli_query($conn, $query)) $success = true;
    else $success = false;
    mysqli_close($conn);
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
    <link rel="stylesheet" href="./style/create.css">
    <script src="./scripts/create.js" defer></script>
    <title>NUOVO POST</title>
</head>

<body>
    <?php require_once 'navbuilder.php' ?>

    <main>
        <h2 id="create_start">Cerca una GIF da allegare al Post, se vuoi.</h2>
        <h3 id="create_h3">Lascia vuoto per le GIFs in tendenza!</h3>
        <form id="tenor_search">
            <input id="tenor_fieldbox" type="text" placeholder="Cerca GIF su Tenor">
            <input id="tenor_button" type="submit" value="Mostra risultati">
            <div id="found_gifs">
            </div>
            <div id="confirm_box" class="success hidden">La GIF è stata selezionata.</div>
        </form>
        <h2 id="create_start">Aggiungi un Titolo e un Commento al Post</h2>
        <form name="postForm" id="postForm" method="post">
            <div id="postName">
                <label name="title">Un titolo accattivante e ricercato!</label>
                <input type="text" id="title" name="title" placeholder="Scrivi qui il tuo titolo..." required>
            </div>
            <div id="postStory">
                <label name="story">Questo spazio è dedicato ai tuoi pensieri.</label>
                <textarea id="story" name="story" placeholder="Oggi la Formula 1..." rows="10" cols="130" required></textarea>
            </div>
			<input type="hidden" id="tenorURL" name="tenorURL" value="">
            <input type="submit" value="Pubblica il tuo Post!">

            <?php
            if (isset($success)) echo '<div class="post_success">Il tuo post è stato pubblicato!</div>';
            else if ($success = false) echo "<div class='post_error'>Errore in fase di pubblicazione. Riprova.</div>";
            ?>
        </form>
    </main>
</body>

</html>