<?php session_start();

if (!isset($_SESSION['user']['id'])) {
    header("Location: main.php");
} else {
    if (!isset($_GET['id']) || !empty($_GET['id'])) {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
            $sql = $dbh->query("SELECT commandes FROM drawings WHERE id = " . stripslashes($_GET['id']));

            if ($sql->rowCount() > 0) {
                $commands = $sql->fetchAll()[0]['commandes'];
                ?>

                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8"/>
                    <title>Pictionnary</title>
                    <link rel="stylesheet" href="css/bootstrap.min.css">
                    <link rel="stylesheet" media="screen" href="css/styles.css" >
                    <script type="text/javascript">
                        var size, color;
                        var drawingCommands = <?=$commands?>;

                        window.onload = function() {
                            var canvas    = document.getElementById('myCanvas2');
                            canvas.width  = 300;
                            canvas.height = 400;
                            var context   = canvas.getContext('2d');

                            canvas.style.marginLeft = ((window.innerWidth - canvas.width) / 2) + "px";

                            window.onresize = function() {
                                canvas.style.marginLeft = ((window.innerWidth - canvas.width) / 2) + "px";
                            };

                            var draw = function(c) {
                                context.beginPath();
                                context.fillStyle = c.color;
                                context.arc(c.x, c.y, c.size, 0, 2 * Math.PI);
                                context.fill();
                                context.closePath();
                            };

                            var clear = function() {
                                context.clearRect(0, 0, canvas.width, canvas.height);
                            };

                            var i = 0;
                            var iterate = function() {
                                if (i >= drawingCommands.length) {
                                    return;
                                }

                                var c = drawingCommands[i];

                                switch (c.command) {
                                    case "draw":
                                        draw(c);
                                        break;
                                    case "clear":
                                        clear();
                                        break;
                                    default:
                                        console.error("cette commande n'existe pas "+ c.command);
                                }

                                i++;
                                setTimeout(iterate,30);
                            };

                            iterate();
                        };

                    </script>
                </head>
                <body>
                <canvas id="myCanvas2"></canvas>
                <a id="btn-retour-guess" class="btn btn-danger" href="main.php">Retour</a>
                </body>
                </html>

                <?php
            } else {
                header("Location: main.php");
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            $dbh = null;
            die();
        }
    } else {
        header("Location: main.php");
    }
}
?>