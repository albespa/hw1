<?php
    require_once "dbconfig.php";
    session_start();

    function checkAuth() {
        return (isset($_SESSION["username"]) ? $_SESSION["username"] : 0);
    }
?>