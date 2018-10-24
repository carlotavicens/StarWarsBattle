<?php

include ('classes.php');
//session_start();

$session_enable = true;
if(empty($_SESSION['welcome']) && empty($_SESSION['information'])) {
   $session_enable = false;
} 

$information = [];
$information = $_SESSION['information'];
$X= $_SESSION["jugador"];
$X = (object) $X;
echo ($X);
var_dump($X);


/*
$object = new stdClass();
foreach ($array as $key => $value)
{
    $object->$key = $value;
}
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vidaRestant = $X->getVida();
    $_SESSION["life"] = $vidaRestant;
    if(!empty($_POST["Shoot"])){
        $X->disparar($enemy);
    } else  if (!empty($_POST["Repair"])) {
        $X->reparar();
    }
}

header('Location: index.php');
?>