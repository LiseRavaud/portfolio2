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
  $email = strip_tags($_POST['email']);
  $sujet = strip_tags($_POST['sujet']);
  $message = strip_tags($_POST['message']);

  //tableau qui stocke nos éventuels messages d'erreur
  $errors = [];

  //validation du nom
  if (empty($nom)) {
    $formIsValid = false;
    $errors[] = "Veuillez renseigner votre nom de famille.";
  } elseif (mb_strlen($nom) <= 2) {
    $formIsValid = false;
    $errors[] = "Votre nom de famille est trop court.";
  } elseif (mb_strlen($nom) > 100) {
    $formIsValid = false;
    $errors[] = "Votre nom de famille est trop long.";
  }
  elseif (is_numeric($nom)){
    $formIsValid = false;
    $errors[]= "Les chiffres ne sont pas autorisés.";
}

  //validation du prenom
  if (empty($prenom)) {
    $formIsValid = false;
    $errors[] = "Veuillez renseigner votre prénom.";
  } elseif (mb_strlen($prenom) <= 2) {
    $formIsValid = false;
    $errors[] = "Votre prénom est trop court.";
  } elseif (mb_strlen($prenom) > 100) {
    $formIsValid = false;
    $errors[] = "Votre prénom est trop long.";
  }
  elseif (is_numeric($prenom)){
    $formIsValid = false;
    $errors[]= "Les chiffres ne sont pas autorisés.";
}

  //validation email
  if (empty($email)) {
    $formIsValid = false;
    $errors[] = "Veuillez renseigner votre e-mail";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $formIsValid = false;
    $errors[] = "Votre email n'est pas valide.";
  }

  //validation du sujet
  if (empty($sujet)) {
    $formIsValid = false;
    $errors[] = "Veuillez renseigner votre sujet.";
  } elseif (mb_strlen($sujet) <= 4) {
    $formIsValid = false;
    $errors[] = "Votre sujet est trop court.";
  } elseif (mb_strlen($sujet) > 191) {
    $formIsValid = false;
    $errors[] = "Votre sujet est trop long.";
  }

  //validation du message
  if (empty($message)) {
    $formIsValid = false;
    $errors[] = "Veuillez renseigner votre message.";
  } elseif (mb_strlen($message) <= 14) {
    $formIsValid = false;
    $errors[] = "Votre message est trop court.";
  } elseif (mb_strlen($message) > 1000) {
    $formIsValid = false;
    $errors[] = "Votre message est trop long.";
  }

  //si le formulaire est valide...
  if ($formIsValid == true) {
    //on écrit tout d'abord notre requête SQL
    $sql = "INSERT INTO formcontact
                (nom, prenom, email, sujet, message, date_created)
                VALUES
                (:nom, :prenom, :email, :sujet, :message, NOW())";

    //envoie une requête au serveur
    $stmt = $pdo->prepare($sql);

    //se prépare à l'exécuter
    $stmt->execute([
      ":nom" => $nom,
      ":prenom" => $prenom,
      ":email" => $email,
      ":sujet" => $sujet,
      ":message" => $message,
    ]);
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name ="description" content ="Développeuse web spécialisée en front-end et UX design.">
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

  <!-------------------- HEADER -------------------->
  <header class="container-fluid" id="haut">

    <div class="row">

      <div class="col-12 col-md-6 presentation">
        <div>
          <h1>Bonjour et bienvenue !
            <h2>Je suis étudiante en Développement Web à Campus Academy, passionnée par le front-end
              et intéressée par le UX/UI design.</h2>
        </div>
      </div>

      <div class="col-12 col-md-6 boutonPC">
        <a class="btn btn-info" href="formRecommandation.php#formRecom" role="button">Venez donner votre avis</a>
      </div>
    </div>
  </header>

  <!-------------------- PARCOURS -------------------->
  <div class="container" id="parComp">
    <div class="row">

      <div class="col-12 col-md-6">
        <div class="media">
          <div class="media-body">
            <h4 class="mt-0">Mon parcours</h4>
            <div class="parcours my-3">
              <span>2019-2022</span>
              <h5>Bachelor Développement Web </h5>
              <p>Campus Academy (IMIE) - Nantes</p>
              <span>2016-2017</span>
              <h5>Licence professionnelle "Accompagnement de publics spécifiques"</h5>
              <p>Antenne universitaire de Beauvais</p>
              <span>2014-2016</span>
              <h5>Master de psychologie cognitive et neuropsychologie</h5>
              <p>Université de Nantes</p>
              <span>2010-2013</span>
              <h5>Licence de psychologie</h5>
              <p>Université de Nantes</p>
              <span>2009</span>
              <h5>Baccalauréat STG (spécialité: Informatique)</h5>
              <p>Lycée Carcouët - Nantes</p>
            </div>
          </div>
        </div>
      </div>

      <!-------------------- COMPETENCES -------------------->
      <div class="col-12 col-md-6 comp">
        <div class="media">
          <div class="media-body">
            <h4 class="mt-0">Mes compétences</h4>
            <div class="container" id="langage">
              <h5>Langages</h5>
              <p>HTML, CSS, JavaScript, PHP, SQL</p>
            </div>

            <div class="container" id="framework">
              <h5>Frameworks</h5>
              <p>Bootstrap</p>
            </div>

            <div class="container" id="framework">
              <h5>En cours d'acquisition</h5>
              <p>Python, React, Jquery</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-------------------- CREATIONS -------------------->
  <div class="container" id="creations">
    <div class="row">
      <div class="col-12">
        <div class="creations">
          <h4>Créations</h4>
          <p>Prochainement sur vos écrans !</p>
        </div>
      </div>
    </div>
  </div>

  <!-------------------- RECOMMANDATIONS -------------------->
  <div class="container" id="recommandations">
    <div class="row">
      <div class="col-12">
        <div class="recommandationPro">
          <h4>Recommandations professionnelles</h4>

          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h2 class="display-4">Recommandation de ..., *métier* à ...</h2>
              <p class="lead">Super travail, bravo ! :)</p>
            </div>
          </div>

          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h2 class="display-4">Recommandation de ..., *métier* à ...</h2>
              <p class="lead">Bonne maîtrise de HTML5 et des connaissances qui évolue dans le bon sens en CSS3 ainsi qu'en PHP. Pensez à utiliser davantage de frameworks.</p>
            </div>
          </div>

          <nav aria-label="...">
            <ul class="pagination">
              <li class="page-item ">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="false">Précédent</a>
              </li>
              <li class="page-item active"><a class="page-link" href="accueil.php#recommandations">1</a></li>
              <li class="page-item" aria-current="page">
                <a class="page-link" href="accueil.php#recommandations">2 <span class="sr-only">(current)</span></a>
              </li>
              <li class="page-item"><a class="page-link" href="accueil.php#recommandations">3</a></li>
              <li class="page-item">
                <a class="page-link" href="accueil.php#recommandations">Suivant</a>
              </li>
            </ul>
          </nav>

        </div>
      </div>
    </div>
  </div>

  <!-------------------- CONTACT -------------------->
  <div class="container-fluid" id="contact">
    <div class="row">
      <div class="col-12 offset-md-1 col-md-6 formContact">
        <h4>Contact</h4>

        <form method="post" action="accueil.php#contact">
          <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" name="nom" id="nom" placeholder="Votre nom" maxlength="100" minlength="3" size="30" required>
          </div>
          <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prénom" maxlength="100" minlength="3" size="30" required>
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Votre e-mail" maxlength="191" minlength="10" size="30" required>
            <small id="email" class="form-text text-muted">Votre adresse e-mail restera confidentielle.</small>
          </div>
          <div class="form-group">
            <label for="sujet">Sujet</label>
            <input type="text" class="form-control" name="sujet" id="sujet" placeholder="Sujet" maxlength="191" minlength="5" size="30" required>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea type="text" class="form-control" name="message" id="message" rows="3" placeholder="Veuillez entrer votre message" maxlength="1000" minlength="15" size="50" required></textarea>
          </div>

          <?php
          //affiche les éventuelles erreurs de validation
          if (!empty($errors)) {
            foreach ($errors as $error) {
              echo '<div>' . $error . '</div>';
            }
          }
          ?>

          <button type="submit" class="btn btn-info">Envoyer</button>
        </form>

      </div>
    </div>
  </div>

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
        <p>&copy; <?= date("Y") ?> Lise Ravaud | <a href="mentionsLegales.php#ml">Mentions légales</a></p>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="
  sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <script>
    $(function() {
      $('nav a[href^="#"]').click(function() {
        var the_id = $(this).attr("href");
        if (the_id === '#') {
          return;
        }
        var positionCible = $(the_id).offset().top - 92
        $('html,body').animate({
          scrollTop: positionCible
        }, 'slow');
        return false;
      });
    })
  </script>

</body>

</html>