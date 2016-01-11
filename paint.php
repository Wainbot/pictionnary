<?php session_start();

if (!isset($_SESSION['user']['prenom'])) {
    header("Location: main.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <title>Pictionnary</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="css/styles.css" >
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script type="text/javascript">
        var sizes = [8, 20, 44, 90];
        var size, color;
        var drawingCommands = [];

        var setColor = function() {
            color = document.getElementById('color').value;
            console.log("color:" + color);
        };

        var setSize = function() {
            size = sizes[document.getElementById('size').value];
            console.log("size:" + size);
        };

        window.onload = function() {
            var canvas    = document.getElementById('myCanvas');
            canvas.width  = 300;
            canvas.height = 400;
            var context   = canvas.getContext('2d');

            canvas.style.marginLeft = ((window.innerWidth - canvas.width) / 2) + "px";

            window.onresize = function() {
                canvas.style.marginLeft = ((window.innerWidth - canvas.width) / 2) + "px";
            };

            setSize();
            setColor();

            document.getElementById('size').onchange  = setSize;
            document.getElementById('color').onchange = setColor;

            var isDrawing = false;

            var startDrawing = function(e) {
                isDrawing = true;
            };

            var stopDrawing = function(e) {
                isDrawing = false;
            };

            var draw = function(e) {
                if (isDrawing) {
                    drawingCommands.push({
                        command : "draw",
                        x : e.x - this.offsetLeft,
                        y : e.y - this.offsetTop,
                        size: size / 2,
                        color: color
                    });

                    context.beginPath();
                    context.fillStyle = color;
                    context.arc(e.x - this.offsetLeft, e.y - this.offsetTop, size / 2, 0, 2 * Math.PI);
                    context.fill();
                    context.closePath();
                }
            };

            canvas.onmousedown = startDrawing;
            canvas.onmouseout  = stopDrawing;
            canvas.onmouseup   = stopDrawing;
            canvas.onmousemove = draw;

            document.getElementById('restart').onclick = function() {
                drawingCommands.push({
                    command : "clear"
                });

                context.clearRect(0, 0, canvas.width, canvas.height);
            };

            document.getElementById('validate').onclick = function() {
                document.getElementById('drawingCommands').value = JSON.stringify(drawingCommands);
                document.getElementById('picture').value = canvas.toDataURL();
            };

            $("#my-tools").draggable();
        };
    </script>
</head>
<body>

<canvas id="myCanvas"></canvas>

<div class="panel panel-default col-md-4" id="my-tools">
    <div class="panel-body">
        <form name="tools" action="req_paint.php" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3 control-label" for="size">Taille&nbsp;:</label>
                <div class="col-md-9">
                    <input class="input-md" type="range" id="size" min="0" max="3" step="1" value="0"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="color">Couleur&nbsp;:</label>
                <div class="col-md-9">
                    <input class="form-control input-md" type="color" id="color" value="#000000" onchange=""/>
                </div>
            </div>

            <br />

            <div class="form-group text-center">
                <a class="btn btn-danger" href="main.php">Annuler</a>
                <input class="btn btn-primary" id="restart" type="button" value="Recommencer"/>
                <input type="hidden" id="drawingCommands" name="drawingCommands"/>
                <!-- à quoi servent ces champs hidden ? -->
                <!--  * Ces champs servent à envoyer des données qui ne sont pas contenus dans des input par default mais plutôt des données calculées -->
                <input type="hidden" id="picture" name="picture"/>
                <input class="btn btn-success" id="validate" type="submit" value="Valider"/>
            </div>
        </form>
    </div>
</div>
</body>
</html>