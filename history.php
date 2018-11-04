<?php

$servername = "localhost";
$username = "mamp";
$password = "";
$dbName = "StarWarsBattle";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST["Show"])){

        if(!isset($_SESSION["historial"])){
            echo($_SESSION["historial"] . "\n");
        } else {
            unset($_SESSION["historial"]);
        }

        $conn = mysqli_connect($servername, $username, $password, $dbName);
        $sql = "SELECT * FROM history";
        $info = $sql;
        $_SESSION["historial"] = $info;

    } else if (!empty($_POST["Delete"])) {
        $conn = mysqli_connect($servername, $username, $password, $dbName);
        $sql = "DELETE FROM history";

        $conn->close();
    }
}

header('Location: index.php');
?>