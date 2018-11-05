<?php

require_once('classes.php');
session_start();

$session_enable = true;
if(empty($_SESSION['welcome']) && empty($_SESSION['information'])) {
   $session_enable = false;
} 
unset($_SESSION["welcome"]); //Quitamos la variable de sesión con tal de que cuando empiece el juego ya no aparezca.

$information = $_SESSION['information']; //Asignamos las variables de sesión a variables del fichero.
$enemigos = $_SESSION['enemies'];
$player = $_SESSION["jugadorobj"];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!empty($_POST["Shoot"])){                                            //Si dispara y si el tamaño del array de enemigos es mas grande que 0
            if(sizeof($enemigos) > 0 && $player->getVida() > 0) {               // y el jugador tiene vidas se ejecuta el contenido, donde el jugador dispara
                unset($_SESSION["win"]);                                        // y el enemigo realiza una acción aleatoria y se sobrescriben las variables
                $player->disparar($enemigos[0]);                                // de sesión con los valores actuales.
                $enemigos[0]->escollir_accio($player);
                if($enemigos[0]->getVida() <= 0 && sizeof($enemigos) > 0) {
                    array_splice($enemigos, 0, 1);
                }
                $_SESSION['jugadorobj'] = $player;
                $_SESSION['enemies'] = $enemigos;
            }
        } else if (!empty($_POST["Repair"])) {
            if(sizeof($enemigos) > 0 && $player->getVida() >= 0) {
                $player->reparar();
                $enemigos[0]->escollir_accio($player);
                $_SESSION['jugadorobj'] = $player;
            }
        }
    }

header('Location: index.php');
?>