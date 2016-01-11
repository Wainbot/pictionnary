<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Pictionnary</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="css/styles.css">
</head>
<body>

<div class="container">

    <?php session_start();

    if (isset($_SESSION['user'])) {
        ?>

        <br />
        <div class="jumbotron text-center">
            <h1>Bonjour <?=$_SESSION['user']['prenom']?> !</h1>
            <img class="img-thumbnail img-rounded img-circle" src="<?=$_SESSION['user']['profilepic']?>" alt="profil">
            <p>
                <br />
                <a class="btn btn-primary btn-sm" href="logout.php" role="button">Se déconnecter</a>
            </p>
        </div>

        <?php
    } else {
        ?>

        <br />
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Connectez-vous</div>
                <div class="panel-body">
                    <form action="req_login.php" method="post" class="form-horizontal">
                        <?php if (isset($_GET['erreur'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?=$_GET['erreur']?>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email</label>
                            <div class="col-md-8">
                                <input class="form-control input-md" type="text" name="email" id="email" placeholder="email" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">Mot de passe</label>
                            <div class="col-md-8">
                                <input class="form-control input-md" type="password" name="password" id="password" placeholder="mot de passe" required/>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a href="inscription.php" class="btn btn-warning">S'inscrire</a>
                            <input class="btn btn-primary" type="submit" value="Se connecter">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }
    ?>
