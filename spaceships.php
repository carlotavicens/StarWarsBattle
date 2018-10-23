<?php
    include_once ('classes.php');

    $tArray = [];
    for ($i = 0; $i < 5; $i++) {
        $T = new TIE_Fighter($i+1,'Res', 20, 20, 2);
        array_push($tArray, $T);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numSerie = test_input($_POST["numeroDeSerie"]);
        $r2d2 = test_input($_POST["wantR2d2"]);
      }

    if ($r2d2 == on) {
        $r2d2 = 'true';
    }else {
        $r2d2 = 'false';
    }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    $X = new X_Wing ($numSerie,'Res', 20, 20, 2, $r2d2, 100, 100);

    session_start();

    $infoArray = [];

    array_push($infoArray, $X->getNumSerie);
    array_push($infoArray, $X->getR2d2());
    array_push($infoArray, date("Y-m-d H:i:s"));
    array_push($infoArray, count($tArray));
 
    session_start();

    $_SESSION["information"] = $infoArray;
    
    $_SESSION["welcome"] = "Welcome traveller!";

    header ("Location: index.php");


?>