<?php
//se connecte à la base de données
//crée la variable $pdo pour accéder à la bdd
include('db.php');

//on récupère les données du formulaire
if (!empty($_POST)) {
    // par défaut, on dit que le formulaire est entièrement valide, si erreur cette variable aura pour valeur "false"
    $formIsValid = true;

    // on fait un strip_tags pour se protéger des attaques XSS
    $nom = strip_tags($_POST['nom']);
    $prenom = strip_tags($_POST['prenom']);
    $metier = strip_tags($_POST['metier']);
    $entreprise = strip_tags($_POST['entreprise']);
    $message = strip_tags($_POST['message']);

    $EmailTo = "xxxxx.xxxx@xxxx.fr";
    $Subject = "PORTFOLIO RECOMMANDATION : ";
    $header = "From:" . $email . "\r\n";
    $header .= 'X-Mailer: PHP/' . phpversion();
    $Body = "Nom : ";
    $Body .= $nom;
    $Body .= "\n";
    $Body .= "Prénom : ";
    $Body .= $prenom;
    $Body .= "\n";
    $Body .= "Métier : ";
    $Body .= $metier;
    $Body .= "\n";
    $Body .= "Entreprise : ";
    $Body .= $entreprise;
    $Body .= "\n";
    $Body .= "Message : ";
    $Body .= $message;
    $Body .= "\n";

    //tableau qui stocke nos éventuels messages d'erreur
    $errors = [];

    //validation du nom
    if (empty($nom)) {
        $formIsValid = false;
        $errors[] = "Veuillez renseigner l'initiale de votre nom.";
    } elseif (mb_strlen($nom) > 2) {
        $formIsValid = false;
        $errors[] = "Seulement l'initiale est demandée.";
    } elseif (is_numeric($nom)) {
        $formIsValid = false;
        $errors[] = "Les chiffres ne sont pas autorisés.";
    }

    //validation du prenom
    if (empty($prenom)) {
        $formIsValid = false;
        $errors[] = "Veuillez renseigner votre prénom.";
    } elseif (mb_strlen($prenom) <= 1) {
        $formIsValid = false;
        $errors[] = "Votre prénom est trop court.";
    } elseif (mb_strlen($prenom) > 100) {
        $formIsValid = false;
        $errors[] = "Votre prénom est trop long.";
    } elseif (is_numeric($prenom)) {
        $formIsValid = false;
        $errors[] = "Les chiffres ne sont pas autorisés.";
    }

    //validation metier
    if (empty($metier)) {
        $formIsValid = false;
        $errors[] = "Veuillez renseigner votre métier";
    } elseif (mb_strlen($metier) <= 4) {
        $formIsValid = false;
        $errors[] = "Votre métier est trop court.";
    } elseif (mb_strlen($metier) > 191) {
        $formIsValid = false;
        $errors[] = "Votre métier est trop long.";
    } elseif (is_numeric($metier)) {
        $formIsValid = false;
        $errors[] = "Les chiffres ne sont pas autorisés.";
    }

    //validation entreprise
    if (empty($entreprise)) {
        $formIsValid = false;
        $errors[] = "Veuillez renseigner le nom de votre entreprise.";
    } elseif (mb_strlen($entreprise) <= 1) {
        $formIsValid = false;
        $errors[] = "Le nom de votre entreprise est trop court.";
    } elseif (mb_strlen($entreprise) > 191) {
        $formIsValid = false;
        $errors[] = "Le nom de votre entreprise est trop long.";
    }

    //validation du message
    if (empty($message)) {
        $formIsValid = false;
        $errors[] = "Veuillez renseigner votre message.";
    } elseif (mb_strlen($message) <= 10) {
        $formIsValid = false;
        $errors[] = "Votre message est trop court.";
    } elseif (mb_strlen($message) > 1000) {
        $formIsValid = false;
        $errors[] = "Votre message est trop long.";
    }

    //si le formulaire est valide...
    if ($formIsValid == true) {
        //on écrit tout d'abord notre requête SQL
        $sql = "INSERT INTO formrecom
                (nom, prenom, metier, entreprise, message, date_created)
                VALUES
                (:nom, :prenom, :metier, :entreprise, :message, NOW())";

        //envoie une requête au serveur
        $stmt = $pdo->prepare($sql);

        //se prépare à l'exécuter
        $stmt->execute([
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":metier" => $metier,
            ":entreprise" => $entreprise,
            ":message" => $message,
        ]);
        $success = mail($EmailTo, $Subject, $Body);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Développeuse web spécialisée en front-end et UX design.">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Kurale|Great+Vibes|Parisienne|Sorts+Mill+Goudy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/mdb.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="shortcut icon" href="./css/lotus_flower.webp">

    <title>Lise Ravaud | Développeuse web</title>
</head>

<body id="haut">

    <!-- MENU DE NAVIGATION -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="accueil.php#haut">Lise Ravaud | Développeuse Web</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="accueil.php#haut">Retour sur le portfolio</a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- FORMULAIRE DE RECOMMANDATIONS -->
    <div class="container-fluid recom">
        <div class="row">
            <div class="col-12 offset-md-2 col-md-6 formRecom">
                <h4 id="FormRecom">Avis</h4>

                <p>Si nous avons travaillé ensemble, vous pouvez écrire ici un avis/une recommandation sur mon travail.</p>

                <form method="post">
                    <div class="form-group">
                        <label for="nom">Initiale de votre nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Initiale" maxlength="1" minlength="1" size="30" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prénom" maxlength="100" minlength="2" size="30" required>
                    </div>
                    <div class="form-group">
                        <label for="metier">Métier</label>
                        <input type="text" class="form-control" name="metier" id="metier" placeholder="Votre métier" maxlength="191" minlength="5" size="30" required>
                    </div>
                    <div class="form-group">
                        <label for="entreprise">Entreprise</label>
                        <input type="text" class="form-control" name="entreprise" id="entreprise" placeholder="Le nom de votre entreprise" maxlength="191" minlength="2" size="30" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="Veuillez entrer votre message" maxlength="1000" minlength="10" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-indigo">Envoyer</button>

                    <?php
                    //affiche les éventuelles erreurs de validation
                    if (!empty($errors)) {
                        foreach ($errors as $error) {
                            echo '<div>' . $error . '</div>';
                        }
                    }

                    //affiche un message de confirmation si le formulaire est valide
                    if (!empty($_POST) && empty($errors)) {
                        echo ("Merci pour votre recommandation !");
                    }
                    ?>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- BANDEAU MENTIONS LEGALES -->
    <div class="container-fluid">
        <div class="row mentionL">
            <div class="col-12 offset-md-2 col-md-6">
                <p>&copy; <?= date("Y") ?> Lise Ravaud | <a href="mentionsLegales.php#ml">Mentions légales</a></p>
            </div>
        </div>
    </div>

</body>

</html>