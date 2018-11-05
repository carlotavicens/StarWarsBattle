<?php
    include ("classes.php");  //Esta clase solo se invoca durante la creación del juegy nunca más. 

    $tArray = [];
    for ($i = 0; $i < 5; $i++) {  //Creamos los enemigos y los ponemos en un array.
        $T = new TIE_Fighter($i+1,'Res', 20, 20, 2);
        array_push($tArray, $T);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numSerie = test_input($_POST["numeroDeSerie"]);
        $r2d2 = test_input($_POST["wantR2d2"]);
      }

    if ($r2d2 == on) {  //En funcíon de R2D2 podrá o no reparar.
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

    $X = new X_Wing ($numSerie,'Res', 20, 20, 2, $r2d2, 50, 30);  //Creamos al jugador
    $arrayX = get_object_vars($X);
    session_start();

    $infoArray = [];

    array_push($infoArray, $X->getNumSerie()); //Creamos el array de información.
    array_push($infoArray, $X->getR2d2());
    array_push($infoArray, date("Y-m-d H:i:s")); //Formateamos la fecha a nuestra elección.
    array_push($infoArray, count($tArray));
 
    $_SESSION["welcome"] = "Welcome traveller!";  //Establecemos las variables de sesión que serán usadas a posteriori. 
    $_SESSION["enemies"] = $tArray;
    $_SESSION["information"] = $infoArray;
    $_SESSION['jugadorobj'] = $X;

    header ("Location: index.php");

?>