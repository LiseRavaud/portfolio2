<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Parisienne|Sorts+Mill+Goudy&display=swap&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/mdb.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="shortcut icon" href="./css/lotus_flower.webp">

    <title>Mentions Légales</title>
</head>

<body id="haut">

<!-- MENU DE NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="accueil.php#haut">Lise Ravaud | Développeuse Web</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" href="accueil.php#haut">Retour sur le portfolio</a>
        </li>
    </div>
</nav>

<!-- CONTENU DE LA PAGE -->
<div class="pageMention" id="ml">
    <div class="row">
    <div class="col-12 offset-md-3 col-md-6 formRecom">
    <h4>Présentation du site</h4>
    <p>En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, 
    il est précisé aux utilisateurs du site lise-ravaud.fr l'identité des différents intervenants dans le cadre de sa réalisation et 
    de son suivi :</p>

    <p>Propriétaire et créateur :<br>
    Lise Ravaud - Etudiante en Développement Web - Nantes (Loire-Atlantique)</p>

    <p>Hébergeur :<br>
    OVH</p>

    <h4>Conditions générales d’utilisation du site</h4>
    <p>L’utilisation du site lise-ravaud.fr implique l’acceptation pleine et entière des conditions générales d’utilisation ci-après décrites.
    Ces conditions d’utilisation sont susceptibles d’être modifiées ou complétées à tout moment.</p>

    <p>Ce site est accessible à tout moment. Une interruption pour raison de maintenance technique peut être toutefois décidée par Lise Ravaud.</p>

    <h4>Propriété intellectuelle</h4>
    <p>Lise Ravaud est propriétaire des droits de propriété intellectuelle.<br>
    Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit 
    le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de Lise Ravaud.</p>

    <p>Toute exploitation non autorisée du site ou de l’un quelconque des éléments qu’il contient sera considérée comme constitutive d’une 
    contrefaçon et poursuivie conformément aux dispositions des articles L.335-2 et suivants du Code de Propriété Intellectuelle.</p>

    <h4>Protection des données personnelles</h4>
    <p>L’internaute peut être amené à communiquer certaines données personnelles (nom, prénom, adresse email, nom de l'entreprise et métier) 
    en répondant aux formulaires qui lui sont proposés, notamment en vue de contacter Lise Ravaud ou d'écrire une recommandation.
    La saisie de ces données est nécessaire au traitement de la demande de l’internaute par Lise Ravaud.</p>

    <p>Lise Ravaud respecte les dispositions de la loi n°78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés 
    modifiée en 2004 et du Règlement européen sur les données personnelles (Règlement UE 2016/679) du 27 avril 2016 et s’engage à 
    prendre toute précaution nécessaire pour préserver la sécurité des informations nominatives confiées. Aucune information à caractère 
    personnel ne sera communiquée à des sociétés tierces sans l’accord préalable et éclairé de l’internaute.</p>

    <p>Conformément aux dispositions des articles 39 et 40 de la loi « Informatique et Libertés » du 6 janvier 1978 modifiée en 2004,
    l’internaute peut à tout moment exercer son droit d’accès, de rectification, de suppression, de mise à jour et d’opposition concernant
    les informations qu’il fournit auprès de Lise Ravaud, par email à l’adresse lise.ravaud@students.campus.academy.</p>
    </div>
    </div>
</div>


<!-------------------- BANDEAU MENTIONS LEGALES -------------------->
<div class="container-fluid">
    <div class="row mentionL">
        <div class="col-12 offset-md-2 col-md-6">
            <p> &copy; <?= date("Y") ?> Lise Ravaud | <a href="mentionsLegales.php#ml">Mentions légales</a></p>
        </div>
    </div>
</div>

</body>
</html>