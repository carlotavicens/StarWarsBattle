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
    session_start();
        $numeroDeSerie = "";
        $wantR2d2 = false;
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
                    <form action="./spaceships.php" method="post">
                        <div class="actions-container">
                            <div class="shoot-container">
                                <button class="button-shoot">Shoot</button>
                            </div>
                            <div class="repair-container">
                                <button class="button-repair">Repair</button>
                            </div>
                        </div>
                        <div class="form-1-textarea">
                            <textarea name="" id="" cols="30" rows="10"><?php echo $_SESSION["welcome"];?>></textarea>
                        </div>
                    </form>
                </div>
                <div class="form-2-container">
                    <div class="history-container">
                        <div class="show-history">
                            <button>Show history</button>
                        </div>
                        <div class="delete-history">
                            <button>Delete history</button>
                        </div>
                    </div>
                    <div class="form-2-textarea">
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <img src="https://i.gifer.com/7V5.gif" alt="" height="130px" width="130px">
        </div>
    </section>
</body>

</html>