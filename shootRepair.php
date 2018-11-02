<?php

require_once('classes.php');
session_start();

$session_enable = true;
if(empty($_SESSION['welcome']) && empty($_SESSION['information'])) {
   $session_enable = false;
} 
unset($_SESSION["welcome"]);

$information = $_SESSION['information'];
$enemigos = $_SESSION['enemies'];
$player = $_SESSION["jugadorobj"];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!empty($_POST["Shoot"])){
            if(sizeof($enemigos) > 0 && $player->getVida() > 0) {
                unset($_SESSION["win"]);
                $player->disparar($enemigos[0]);
                $enemigos[0]->escollir_accio($player);
                if($enemigos[0]->getVida() <= 0 && sizeof($enemigos) > 0) {
                    array_splice($enemigos, 0, 1);
                }
                $_SESSION['jugadorobj'] = $player;
                $_SESSION['enemies'] = $enemigos;
            } else {
                if(sizeof($enemigos) <= 0) {
                    $winner = "Congratulations, you've won the game!";
                    $_SESSION['win'] = $winner;
                    unset($_SESSION["enemies"]);
                    unset($_SESSION["jugadorobj"]);
                } else if ($player->getVida() == 0) {
                    $winner = "oh damn, you've lost the game!";
                    $_SESSION['win'] = $winner;
                    unset($_SESSION["enemies"]);
                    unset($_SESSION["jugadorobj"]);
                }
            } 
        } else if (!empty($_POST["Repair"])) {
            if(sizeof($enemigos) > 0 && $player->getVida() >= 0) {
                $player->reparar();
                $_SESSION['jugadorobj'] = $player;
            }
        }
    }

header('Location: index.php');
?>