<?php include_once("header.php");

if (isset($_SESSION['user'])) { ?>

    <div class="col-md-12 text-center">
        <a href="paint.php" id="btn-commencer-dessin" class="btn btn-lg btn-success">Commencer un dessin</a>
    </div>

    <?php

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
        $sql = $dbh->query("SELECT id FROM drawings WHERE id_utilisateur = " . $_SESSION['user']['id']);

        if ($sql->rowCount() >= 1) {
            echo '<h1 class="text-center">Mes dessins</h1>';
            echo '<div class="panel panel-default col-md-4 col-md-offset-4">'
                . '<table class="table table-condensed">';

            foreach ($sql as $row) {
                ?>
                <tr>
                    <td class="text-center">Dessin n°<?= $row['id'] ?></td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-xs" href="guess.php?id=<?= $row['id'] ?>">voir le dessin</a>
                    </td>
                </tr>
                <?php
            }

            echo '</table>'
                . '</div>';
        }

        $dbh = null;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        $dbh = null;
        die();
    }
}
    ?>

</div>
</body>
</html>
