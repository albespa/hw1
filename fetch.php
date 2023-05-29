<?php

require_once 'redirect.php';
if (!checkAuth()) {
    echo "Errore nell'autenticazione.";
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pass'], $dbconfig['name']) or die(mysqli_error($conn));

if (isset($_GET["posts"])) {
    switch ($_GET["posts"]) {
        case "all":
            $query = "SELECT post.id,username,title,cap,gif 
            FROM posts post JOIN users u ON u.id=post.author 
            ORDER BY post.id DESC";
            $res = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($res)) {
                $posts[] = [
                    "id_post" => $row["id"], 
                    "author" => $row["username"], 
                    "content" => array(
                        "title" => $row["title"], 
                        "caption" => $row["cap"], 
                        "gif" => $row["gif"]
                        )
                    ];
            }

            if (!empty($posts)) echo json_encode($posts);
            else echo 0;
            break;

        case "mine":
            $query = "SELECT post.id,username,title,cap,gif 
            FROM posts post JOIN users u ON u.id=post.author 
            WHERE u.id = '" . $_SESSION["id"] . "' ORDER BY post.id DESC";
            $res = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($res)) {
                $posts[] = [
                    "id_post" => $row["id"],
                    "author" => $row["username"],
                    "content" => array(
                        "title" => $row["title"],
                        "caption" => $row["cap"],
                        "gif" => $row["gif"]
                    )
                ];
            }

            if (!empty($posts)) echo json_encode($posts);
            else echo 0;
            break;

        default:
            echo 0;
            break;
    }
}

if (isset($_GET["search"])) {
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);

    $query = "SELECT p.id,username,title,cap,gif 
    FROM posts p JOIN users u ON u.id=p.author 
    WHERE title LIKE  '%" . $searchQuery . "%' OR cap LIKE '%" . $searchQuery . "%'";
    $res = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($res)) {
        $posts[] = [
            "id_post" => $row["id"],
            "author" => $row["username"],
            "content" => array(
                "title" => $row["title"],
                "caption" => $row["cap"],
                "gif" => $row["gif"]
            ),
            "searchedFor" => $searchQuery,
            "numbersFound" => mysqli_num_rows($res)
        ];
    }

    if (!empty($posts)) echo json_encode($posts);
    else echo 0;
}
