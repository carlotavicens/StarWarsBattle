<?php

$servername = "localhost";
$username = "mamp";
$password = "";
$dbName = "StarWarsBattle";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST["Show"])){  //Para poder mostrar todo el contenido hacemos el select y lo guardamos en una variable. 
                                 //Posteriormente los añadimos un array que será asignado a una variable de sesión que será recogida en index.
        $servername = "localhost";
        $username = "mamp";
        $password = "";
        $dbname = "StarWarsBattle";
        $table = "history";
        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "SELECT * FROM history";
        $result = $conn->query($sql);
        $historyArray = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($historyArray, "id: " . $row["numSerie"]. " - Name: " . $row["r2d2"]. " " . $row["inici"]. " " . $row["fi"] ."<br>");
            }
        } else {
            echo "0 results";
        }

        $_SESSION["historyArray"] = $historyArray;

    } else if (!empty($_POST["Delete"])) {  //Con tal de borrar el historial hacemos un delete de la tabla.

        $servername = "localhost";
        $username = "mamp";
        $password = "";
        $dbname = "StarWarsBattle";
        $table = "history";
        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "DELETE FROM history";

        $stmt = $conn->prepare($sql);
    
        if ($stmt->execute() === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $stmt->close();
        header ("Location: index.php");
        exit();
    }
}

header('Location: index.php');
?>