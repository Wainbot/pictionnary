<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Pictionnary - Inscription</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="css/styles.css">
</head>
<body>

<a href="main.php" class="btn btn-md btn-success" style="z-index: 999; position: fixed; top: 10px; right: 10px;">Je suis déjà inscrit !</a>

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">Inscrivez-vous</div>
            <div class="panel-body">
                <form class="form-horizontal" action="req_inscription.php" method="post" name="inscription">
                    <span class="required_notification">Les champs obligatoires sont indiqués par *</span>
                    <br />
                    <br />
                    <!-- c'est quoi les attributs action et method ? -->
                    <!--  * L'attribut action indique la page sur laquelle les éléments du formulaire vont être envoyés -->
                    <!--  * L'attribut method indique la méthode d'accès dans le protocole HTTP lors de l'envoi du formulaire -->
                    <!-- qu'y a-t-il d'autre comme possibilité que post pour l'attribut method ? -->
                    <!--  * Il existe aussi la méthode GET pour la méthode d'envoi du formulaire -->
                    <?php if (isset($_GET['erreur'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?=$_GET['erreur']?>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">E-mail :</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="email" name="email" id="email" autofocus required/>
                            <!-- quelle est la différence entre les attributs name et id ? -->
                            <!--  * La différence est que l'id est utilisé comme identifiant de l'élément HTML et le name comme identifiant de la donnée qui va être envoyée en post au fichier req_inscription.php -->
                            <!-- c'est lequel qui doit être égal à l'attribut for du label ? -->
                            <!--  * C'est l'id de l'input qui doit correspondre au for sur label -->
                            <span class="help-block">Format attendu "name@something.com"</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="mdp1">Mot de passe :</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="password" name="password" id="mdp1" pattern="[a-zA-Z0-9]{6,8}" onkeyup="validateMdp2()" title = "Le mot de passe doit contenir de 6 à 8 caractères alphanumériques." required>
                            <!-- quels sont les deux scénarios où l'attribut title sera affiché ? -->
                            <!--  * Les deux scénarios sont quand on vadivde le formulaire et que le mot de passe n'est pas entre 6 et 8 caractère et/ou n'est pas alphanumérique -->
                            <!-- encore une fois, quelle est la différence entre name et id pour un input ? -->
                            <!--  * L'id permet de manipuler l'élément HTML et le name donne un nom à la donnée envoyée par le formulaire -->
                            <span class="help-block">De 6 à 8 caractères alphanumériques.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="mdp2">Confirmez mot de passe :</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="password" id="mdp2" required onkeyup="validateMdp2()">
                            <!-- pourquoi est-ce qu'on a pas mis un attribut name ici ? -->
                            <!--  * Il n'y a pas d'attribut name car cet input ne sera pas envoyé dans le formulaire, il est juste nécessaire à la validation du mot de passe -->
                            <!-- quel scénario justifie qu'on ait ajouté l'écouter validateMdp2() à l'évènement onkeyup de l'input mdp1 ? -->
                            <!--  * A chaque fois qu'on modifie les input mot de passe il doivent être checké quelque soit l'ordre de modification. Si on remodifie le premier mot de passe, il faut quand meme qu'il checke si les deux mot de passe sont égaux -->
                            <span class="help-block">Les mots de passes doivent être égaux.</span>
                        </div>
                        <script>
                            validateMdp2 = function(e) {
                                var mdp1 = document.getElementById('mdp1');
                                var mdp2 = document.getElementById('mdp2');
                                if (/^[a-zA-Z0-9]{6,8}$/.exec(mdp1.value) && mdp1.value == mdp2.value) {
                                    // ici on supprime le message d'erreur personnalisé, et du coup mdp2 devient valide.
                                    document.getElementById('mdp2').setCustomValidity('');
                                } else {
                                    // ici on ajoute un message d'erreur personnalisé, et du coup mdp2 devient invalide.
                                    document.getElementById('mdp2').setCustomValidity('Les mots de passes doivent être égaux.');
                                }
                            }
                        </script>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="nom">Nom :</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="text" name="nom" id="nom" placeholder="nom" value="<?=$_GET['nom']?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="prenom">Prénom :</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="text" name="prenom" id="prenom" required placeholder="prénom" value="<?=$_GET['prenom']?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="telephone">Téléphone :</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="tel" name="tel" id="telephone" value="<?=$_GET['tel']?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="site_web">Site Web :</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="url" name="website" id="site_web" value="<?=$_GET['website']?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="sexe-h">Sexe :</label>
                        <div class="col-md-9">
                            <div class="radio">
                                <label for="sexe-h">
                                    <input type="radio" name="sexe" id="sexe-h" value="H" checked/>
                                    Homme
                                </label>
                                &nbsp;
                                <label for="sexe-f">
                                    <input type="radio" name="sexe" id="sexe-f" value="F" />
                                    Femme
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="birthdate">Date de naissance :</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="date" name="birthdate" id="birthdate" required onchange="computeAge()" value="<?=$_GET['birthdate']?>"/>
                            <span class="help-block">Format attendu "JJ/MM/AAAA"</span>
                        </div>
                        <script>
                            computeAge = function(e) {
                                try{
                                    var dateNow      = new Date(Date.now());
                                    var dateBirthday = new Date(Date.parse(document.getElementById("birthdate").valueAsDate));
                                    var age          = dateNow.getYear() - dateBirthday.getYear();

                                    if (dateNow.getMonth() < dateBirthday.getMonth()) {
                                        age--;
                                    } else {
                                        if (dateNow.getDate() > dateBirthday.getDate() && dateNow.getMonth() == dateBirthday.getMonth()) {
                                            age--;
                                        }
                                    }

                                    document.getElementById("age").value =  age;
                                } catch(e) {
                                    document.getElementById("age").value = null;
                                }
                            };

                            window.onload = function() {
                                <?php if (isset($_GET['erreur'])) { ?>
                                computeAge();
                                <?php } ?>
                            };
                        </script>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="age">Age:</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="number" id="age" disabled/>
                            <!-- à quoi sert l'attribut disabled ? -->
                            <!--  * Cet attribut empêche l'utilisateur de pouvoir modifier le contenu de l'input -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="ville">Ville :</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="text" name="ville" id="ville" placeholder="ville" value="<?=$_GET['ville']?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="taille">Taille :</label>
                        <div class="col-md-9">
                            <input class="input-md" type="range" name="taille" id="taille" min="0" max="2.50" step="0.01" <?=(isset($_GET['taille']))?'value="'.$_GET['taille'].'"' : '' ?>/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="couleur_preferee">Couleur préférée :</label>
                        <div class="col-md-9">
                            <input class="form-control input-md" type="color" name="couleur" id="couleur_preferee" value="<?php echo (isset($_GET['couleur'])) ? urldecode($_GET['couleur']) : "#000000" ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="profilepicfile">Photo de profil :</label>
                        <div class="col-md-9">
                            <input class="input-file" type="file" id="profilepicfile" onchange="loadProfilePic(this)" />
                            <span class="help-block">Choisissez une image.</span>
                            <input type="hidden" name="profilepic" id="profilepic"/>
                            <canvas id="preview" width="0" height="0"></canvas>
                        </div>
                        <script type="text/javascript">
                            loadProfilePic = function (e) {
                                var canvas  = document.getElementById("preview");
                                var ctx     = canvas.getContext("2d");

    //                    ctx.setFillColor("white");
                                ctx.fillRect(0,0,canvas.width,canvas.height);

                                canvas.width    = 0;
                                canvas.height   = 0;
                                var file        = document.getElementById("profilepicfile").files[0];
                                var img         = document.createElement("img");
                                var reader      = new FileReader();

                                reader.onload = function(e) {
                                    if (!file.type.match(/image.*/)) {
                                        document.getElementById("profilepicfile").setCustomValidity("Il faut télécharger une image.");
                                        document.getElementById("profilepicfile").value = "";
                                    } else {
                                        img.src = e.target.result;
                                        document.getElementById("profilepicfile").setCustomValidity("");
                                        var MAX_WIDTH   = 96;
                                        var MAX_HEIGHT  = 96;
                                        var width       = img.width;
                                        var height      = img.height;
                                        var ratio       = null;

                                        if (width > height) {
                                            if (width > MAX_WIDTH) {
                                                ratio = width / MAX_WIDTH;
                                                width  = MAX_WIDTH;
                                                height = height / ratio;
                                            }
                                        } else {
                                            if (height > MAX_HEIGHT) {
                                                ratio = height / MAX_HEIGHT;
                                                height  = MAX_HEIGHT;
                                                width = width / ratio;
                                            }
                                        }

                                        canvas.width  = width;
                                        canvas.height = height;
                                        ctx.drawImage(img, 0, 0, width, height);
                                        document.getElementById("profilepic").value = canvas.toDataURL("image/png");
                                    }
                                };

                                reader.readAsDataURL(file);
                            }
                        </script>
                    </div>
                    <br />
                    <div class="form-group text-center">
                        <input class="btn btn-primary" type="submit" value="Soumettre Formulaire">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>