<?php

$email      = stripslashes($_POST['email']);
$password   = stripslashes($_POST['password']);
$nom        = stripslashes($_POST['nom']);
$prenom     = stripslashes($_POST['prenom']);
$tel        = stripslashes($_POST['tel']);
$website    = stripslashes($_POST['website']);
$sexe       = '';

if (array_key_exists('sexe',$_POST)) {
    $sexe = stripslashes($_POST['sexe']);
}

$birthdate  = stripslashes($_POST['birthdate']);
$ville      = stripslashes($_POST['ville']);
$taille     = stripslashes($_POST['taille']);
$couleur    = stripslashes($_POST['couleur']);
$profilepic = stripslashes($_POST['profilepic']);

try {
    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
    $sql = $dbh->query("SELECT * FROM USERS WHERE email = '".$email."'");

    if ($sql->rowCount() >= 1) {
        header('Location: inscription.php?' .
              'nom='          . urlencode($nom)
            . '&prenom='      . urlencode($prenom)
            . '&tel='         . urlencode($tel)
            . '&website='     . urlencode($website)
            . '&sexe='        . urlencode($sexe)
            . '&birthdate='   . urlencode($birthdate)
            . '&ville='       . urlencode($ville)
            . '&taille='      . urlencode($taille)
            . '&couleur='     . urlencode($couleur)
            . '&erreur='      . urlencode("Adresse email déjà utilisée !")
        );
    } else {
        $sql = $dbh->prepare("INSERT INTO users (email, password, nom, prenom, tel, website, sexe, birthdate, ville, taille, couleur, profilepic) "
            . "VALUES (:email, :password, :nom, :prenom, :tel, :website, :sexe, :birthdate, :ville, :taille, :couleur, :profilepic)");
        $sql->bindValue(":email"    , $email);
        $sql->bindValue(":password" , $password);
        $sql->bindValue(":nom"      , (empty($nom)) ? NULL : $nom);
        $sql->bindValue(":prenom"   , (empty($prenom)) ? NULL : $prenom);
        $sql->bindValue(":tel"      , (empty($tel)) ? NULL : $tel);
        $sql->bindValue(":website"  , (empty($website)) ? NULL : $website);
        $sql->bindValue(":sexe"     , (in_array($sexe, array('H', 'F'))) ? $sexe : '');
        $sql->bindValue(":birthdate", (empty($birthdate)) ? NULL : $birthdate);
        $sql->bindValue(":ville"    , (empty($ville)) ? NULL : $ville);
        $sql->bindValue(":taille"   , (empty($taille)) ? NULL : $taille);
        $sql->bindValue(":couleur"  , ltrim($couleur, '#'));
        $sql->bindValue(":profilepic", (empty($profilepic)) ? NULL : $profilepic);

        if (!$sql->execute()) {
            echo "PDO::errorInfo():<br/>";
            $err = $sql->errorInfo();
            print_r($err);
        } else {
            session_start();

            $sql = $dbh->query("SELECT u.id, u.email, u.nom, u.prenom, u.couleur, u.profilepic FROM USERS u WHERE u.email='".$email."'");
            if ($sql->rowCount()<1) {
                header("Location: main.php?erreur=".urlencode("un problème est survenu"));
            }
            else {
                $_SESSION['user'] = $sql->fetchAll(PDO::FETCH_ASSOC)[0];
            }

            header("Location: main.php");
        }
        $dbh = null;
    }
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $dbh = null;
    die();
}