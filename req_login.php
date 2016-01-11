<?php

$email      = stripslashes($_POST['email']);
$password   = stripslashes($_POST['password']);

try {
    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
    $sql = $dbh->query("SELECT * FROM USERS WHERE email = '" . $email . "' AND password = '" . $password . "'");

    if ($sql->rowCount() == 0) {
        header('Location: main.php?erreur=' . htmlentities("Email ou mot de passe incorrecte !"));
    } else {
        session_start();
        $_SESSION['user'] = $sql->fetchAll(PDO::FETCH_ASSOC)[0];
        header("Location: main.php");
        $dbh = null;
    }
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $dbh = null;
    die();
}