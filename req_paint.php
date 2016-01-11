<?php session_start();

if (!isset($_SESSION['user']['prenom'])) {
    header("Location: main.php");
}

$drawingCommands = stripslashes($_POST['drawingCommands']);
$picture         = stripslashes($_POST['picture']);

try {
    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
    $sql = $dbh->prepare("INSERT INTO drawings (id_utilisateur, commandes, dessin) VALUES (:id_utilisateur, :commandes, :dessin)");
    $sql->bindValue(":id_utilisateur" , $_SESSION['user']['id']);
    $sql->bindValue(":commandes"      , $drawingCommands);
    $sql->bindValue(":dessin"         , $picture);

    if (!$sql->execute()) {
        echo "PDO::errorInfo():<br/>";
        $err = $sql->errorInfo();
        print_r($err);
    } else {
        header("Location: main.php");
    }

    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $dbh = null;
    die();
}