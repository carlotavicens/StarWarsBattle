<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
</head>
    <?php
        require_once('classes.php');
        session_start();
        $numeroDeSerie = "";
        $wantR2d2 = false;

        $enemigos = $_SESSION['enemies'];       //Cogemos todas la variables de sesión y las guardamos en variables del fichero.
        $player = $_SESSION["jugadorobj"];
        $infoArray = $_SESSION["information"];
        $fiPartida = date("Y-m-d H:i:s");
        $numSerie = $infoArray[0];



        $servername = "localhost";  //Declaramos el contenido de las variables para poder realizar la conexión SQL. 
        $username = "mamp";
        $password = "";
        $dbName = "StarWarsBattle";


        if(sizeof($enemigos) <= 0) {                                                    //Si no hay enemigos ganamos la partida y añadimos los datos en la BBDD.
            $conn = mysqli_connect($servername, $username, $password, $dbName);
            $sql = "INSERT INTO history (numSerie, r2d2, inici, fi)
            VALUES ('$numSerie', '$infoArray[1]', '$infoArray[2]', '$fiPartida')";

            if ($conn->query($sql) === TRUE) {
                // echo "New record created successfully";
            } else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $winner = "Congratulations, you've won the game!"; //Además añadimos una variable de sesión con la condición de victoria. 
            $_SESSION['win'] = $winner;
            unset($_SESSION["enemies"]);
            unset($_SESSION["jugadorobj"]);
            unset($_SESSION["information"]);

            $conn->close();
        } else if ($player->getVida() == 0) {               //Si perdemos repetimos lo comentado anteriormente pero en otras cicunstancias. 
            $conn = mysqli_connect($servername, $username, $password, $dbName);
            $sql = "INSERT INTO history (numSerie, r2d2, inici, fi)
            VALUES ('$numSerie', '$infoArray[1]', '$infoArray[2]', '$fiPartida')";

            if ($conn->query($sql) === TRUE) {
                // echo "New record created successfully";
            } else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $winner = "oh damn, you've lost the game!";
            $_SESSION['win'] = $winner;
            unset($_SESSION["enemies"]);
            unset($_SESSION["jugadorobj"]);
            unset($_SESSION["information"]);

            $conn->close();
        }
    ?>
<body>
    <section class="container">
        <div class="main-aligner">
            <header class="main-title">Star wars Battle</header>
            <form action="./spaceships.php" method="post">
                <div class="info">
                    <div class="input-form-1">
                        <input type="text" name="numeroDeSerie" id="" class="input" placeholder="Número de serie">
                    </div>
                    <div class="input-form-2">
                        <div>R2D2</div>
                        <input type="checkbox" class="input" class="checkbox-input" name="wantR2d2">
                    </div>
                    <button>New game</button>
                </div>
            </form>
            <div class="form-container">
                <div class="form-1-container">
                    <form action="./shootRepair.php" method="post">
                        <div class="actions-container">
                            <div class="shoot-container">
                                <input type="submit" id="shoot" class="button-shoot" name="Shoot">
                            </div>
                            <div class="repair-container">
                                <input type="submit" id="repair" class="button-repair" name="Repair">
                            </div>
                        </div>
                        <div class="form-1-textarea">
                            <textarea name="" id="" cols="30" rows="10"><?php           //En función de las variables de sesión mostramos el contenido en vivo.
                                if(isset($_SESSION["welcome"])){
                                    echo($_SESSION["welcome"] . "\n");
                                }
                                if(isset($_SESSION["jugadorobj"])){
                                    $player = $_SESSION["jugadorobj"];
                                    echo "Vida restante del jugador: " . $player->getVida() . "\n";
                                    echo "Escudo restante del jugador: " . $player->getEscut() . "\n";
                                }
                                if(isset($_SESSION["enemies"])){
                                    $enemigos = $_SESSION["enemies"];
                                    echo "Enemigos restantes: " . sizeof($enemigos) . "\n";
                                    echo "Vida enemigo: " . $enemigos[0]->getVida() . "\n";
                                }
                                if(isset($_SESSION["win"])){
                                    $win = $_SESSION["win"];
                                    echo $win;
                                }
                                ?>
                            </textarea>
                        </div>
                    </form>
                </div>
                <div class="form-2-container">
                <form action="./history.php" method="post">
                    <div class="history-container">
                        <div class="show-history">
                            <input type="submit" id="show" class="button-shoot" name="Show">
                        </div>
                        <div class="delete-history">
                            <input type="submit" id="delete" class="button-shoot" name="Delete">
                        </div>
                    </div>
                    <div class="form-2-textarea">
                        <textarea name="" id="" cols="30" rows="10">
                        <?php
                        if(isset($_SESSION["historyArray"])){           //Cogemos toda la información del select de history y la mostramos por pantalla en el textarea.
                            $historyArray = $_SESSION["historyArray"];
                            for ($i=0; $i<count($historyArray); $i++) {
                                echo $historyArray[$i];
                            }
                        }
                        ?>
                        </textarea>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById("shoot").value = "Disparar";
        document.getElementById("repair").value = "Reparar";
        document.getElementById("show").value = "Mostrar historial";
        document.getElementById("delete").value = "Eliminar historial";
    </script>
</body>

</html>