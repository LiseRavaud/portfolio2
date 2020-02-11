<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Kurale|Great+Vibes|Parisienne&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../portfolio/css/index.css">
    <link rel="shortcut icon" href="../portfolio/css/logo.png">

    <title>Lise Ravaud | Développeuse web</title>
</head>

<body id="haut">

    <!-------------------- MENU DE NAVIGATION -------------------->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#haut"><img src="../portfolio/css/logo.png" alt="logo temporaire du portfolio">Lise Ravaud</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#haut">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#parComp">Parcours & Compétences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#creations">Créations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#recommandations">Recommandations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- contenu spécifique à cette page -->
    <h2>Erreur 404</h2>
    <p>Cette page n'existe pas !</p>


    <!-------------------- FOOTER -------------------->
    <footer class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4">
                <p>Où me trouver: <br>
                    Nantes (44)</p>
            </div>

            <div class="col-12 col-md-4">
                <a href="https://www.linkedin.com/in/lise-ravaud-dev-web" target="_blank"><img src="../portfolio/css/iconeLK.png" class="icone" alt="Logo site Linkedin"></a>
            </div>
            <a class="btn btn-light btn-sm" href="#haut" role="button">Retour en haut du site</a>
        </div>
    </footer>

    <!-------------------- BANDEAU MENTIONS LEGALES -------------------->
    <div class="container-fluid">
        <div class="row mentionL">
            <div class="col-12 offset-md-2 col-md-6">
                <p>&copy; <?= date("Y") ?> Lise Ravaud | <a href="mentionsLegales.html#ml">Mentions légales</a></p>
            </div>
        </div>
    </div>
</body>

</html>