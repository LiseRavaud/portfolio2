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

  // Préparation du mail
  $EmailTo = "xxxxx.xxxx@xxxx.com";
  $Subject = "PORTFOLIO CONTACT : " . $sujet;
  $header = "From:" . $email . "\r\n";
  $header .= 'X-Mailer: PHP/' . phpversion();
  $Body = "Nom : ";
  $Body .= $nom;
  $Body .= "\n";
  $Body .= "Prénom : ";
  $Body .= $prenom;
  $Body .= "\n";
  $Body .= "E-mail : ";
  $Body .= $email;
  $Body .= "\n";
  $Body .= "Sujet : ";
  $Body .= $sujet;
  $Body .= "\n";
  $Body .= "Message : ";
  $Body .= $message;
  $Body .= "\n";

  //tableau qui stocke les éventuels messages d'erreur
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
  } elseif (is_numeric($nom)) {
    $formIsValid = false;
    $errors[] = "Les chiffres ne sont pas autorisés.";
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
  } elseif (is_numeric($prenom)) {
    $formIsValid = false;
    $errors[] = "Les chiffres ne sont pas autorisés.";
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
    $success = mail($EmailTo, $Subject, $Body);
  }

}

//afficher les recommandations reçues
$sql = "SELECT nom, prenom, metier, entreprise, message, DAY(date_created) AS jour, MONTH(date_created) AS mois, YEAR(date_created) as annee
      FROM formrecom
      ORDER BY date_created DESC
      LIMIT 4";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Développeuse web front-end et back-end.">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Kurale|Great+Vibes|Parisienne|Lobster|Sorts+Mill+Goudy|EB+Garamond&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/mdb.css">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="shortcut icon" href="./css/lotus_flower.webp">

  <title>Lise Ravaud | Développeuse web</title>
</head>

<body>

  <!-- MENU DE NAVIGATION -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#haut">Lise Ravaud | Développeuse Web</a>
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

  <!-- HEADER -->
  <header class="container-fluid" id="haut">

    <div class="row">

      <div class="col-12 presentation justify-content-center">
        <div>
          <h1>Bonjour et bienvenue !</h1>
            <h2>Je suis étudiante en Développement Web à Campus Academy.<br>
            Après avoir participé à différents projets web, je me passionne par le front-end et suis très intéressée pour progresser en UX/UI design.<br>
          Je renoue avec ma créativité, je m'amuse et je m'épanouis dans cette formation et à l'idée d'exercer ce métier.</h2>
        </div>
      </div>

    </div>
  </header>

  <!-- PARCOURS -->
  <div class="container" id="parComp">
    <div class="row">
      <div class="col-12 col-md-6 mt-3">
        <div class="media">
          <div class="media-body">
            <h4 class="mt-0">Mon parcours</h4>
            <section class="parcours my-3 borderParc">

              <div class="row">
                <div class="col-sm-4 imgParcours">
                  <img src="./css/CAMPUS_ACADEMY.png" class="align-self-center" alt="logo Campus Academy">
                </div>
                <div class="col-sm-8">
                  <span>2019-2022</span>
                  <h5>Bachelor Développement Web </h5>
                  <p>Campus Academy (IMIE) - Nantes</p>
                </div>
              </div>

              <div class="row border1">
                <div class="col-sm-4 imgParcours">
                  <img src="./css/picardie.png" class="align-self-center" alt="logo Université de Picardie">
                </div>
                <div class="col-sm-8">
                  <span>2016-2017</span>
                  <h5>Licence professionnelle "Accompagnement de publics spécifiques"</h5>
                  <p>Antenne universitaire de Beauvais</p>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4 imgParcours">
                  <img src="./css/universiteNantes.png" class="align-self-center" alt="logo Université de Nantes">
                </div>
                <div class="col-sm-8">
                  <span>2014-2016</span>
                  <h5>Master de psychologie cognitive et neuropsychologie</h5>
                  <p>Université de Nantes</p>
                </div>
              </div>

              <div class="row border1">
                <div class="col-sm-4 imgParcours">
                  <img src="./css/universiteNantes.png" class="align-self-center" alt="logo Université de Nantes">
                </div>
                <div class="col-sm-8">
                  <span>2010-2013</span>
                  <h5>Licence de psychologie</h5>
                  <p>Université de Nantes</p>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4 imgParcours">
                  <img src="./css/lycee.png" class="align-self-center" alt="logo Lycée Carcouët">
                </div>
                <div class="col-sm-8">
                  <span>2009</span>
                  <h5>Baccalauréat STG (spécialité: Informatique)</h5>
                  <p>Lycée Carcouët - Nantes</p>
                </div>
              </div>


            </section>
          </div>
        </div>
      </div>

      <!-- COMPETENCES -->
      <div class="col-12 col-md-6 comp mt-3">
        <div class="media">
          <div class="media-body">
            <h4 class="mt-0">Mes compétences</h4>

            <section class="border">
              <h6><img src="./css/computer.png" class="align-self-center mr-2" alt="logo code">Compétences techniques</h6>
              <div class="alignImg">
                <img src="./css/html5.png" class="align-self-center" alt="logo html5">
                <img src="./css/css3.png" class="align-self-center" alt="logo css3">
                <img src="./css/js.png" class="align-self-center" alt="logo javascript">
                <img src="./css/php.png" class="align-self-center" alt="logo php">
                <img src="./css/sql.png" class="align-self-center" alt="logo sql">
              </div>
            </section>

            <section class="border">
              <h6><img src="./css/teamwork.png" class="align-self-center mr-2" alt="logo savoir-être">Savoir-être</h6>
              <div class="row">
                <div>
                  <p>Ecoute active</p>
                  <p>Empathie</p>
                  <p>Gestion du stress</p>
                  <p>Réactivité</p>
                </div>
                <div>
                  <p>Curiosité</p>
                  <p>Gestion des conflits</p>
                  <p>Travail en équipe</p>
                </div>
              </div>

            </section>

            <section class="border">
              <h6><img src="./css/psychology-symbol.png" class="align-self-center mr-2" alt="logo psy">Compétences en psychologie</h6>
              <div class="imgBrain"><img src="./css/intelligence.png" class="align-self-center mr-2" alt="logo étude du cerveau">Fonctionnement du cerveau, sa structure anatomique, et ses dysfonctionnements</div>
              <div><img src="./css/sd-card.png" class="align-self-center mr-2" alt="logo mémoire">Connaissances des différentes mémoires, leur fonctionnement et leurs dysfonctionnements</div>
              <div class="imgSocial"><img src="./css/crm.png" class="align-self-center mr-2" alt="logo social">Fonctionnement d'un groupe et ses interactions sociales</div>
              <div><img src="./css/handicap.png" class="align-self-center mr-2" alt="logo social">Connaissances des différents types de handicaps et leurs troubles associés</div>
            </section>

          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- CREATIONS -->
  <div class="container" id="creations">
    <div class="row">
      <div class="col-12 mask">
        <div class="creations">
          <h4>Créations</h4>
          <ul class="nav nav-pills mb-4 mt-4 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-tout-tab" data-toggle="pill" href="#pills-tout" role="tab" aria-controls="pills-tout" aria-selected="true">Tout</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-creations-personnelles-tab" data-toggle="pill" href="#pills-creations-personnelles" role="tab" aria-controls="pills-creations-personnelles" aria-selected="false">Créations personnelles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-creations-professionnelles-tab" data-toggle="pill" href="#pills-creations-professionnelles" role="tab" aria-controls="pills-creations-professionnelles" aria-selected="false">Créations professionnelles</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-tout" role="tabpanel" aria-labelledby="pills-tout-tab">
              <div class="py-5 service-24">
                <div class="container">
                  <div class="row wrap-service-24">

                    <div class="col-lg-3 col-md-6">
                      <div class="card rounded card-shadow border-0 mb-4">
                        <a href="javascript:void(0)" class="card-hover py-4 text-center d-block rounded">
                          <span class="bg-success-grediant">P</span>
                          <h6 class="ser-title">Portfolio (en cours)</h6>
                        </a>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                      <div class="card card-shadow border-0 mb-4">
                        <a href="javascript:void(0)" class="card-hover py-4 text-center d-block rounded">
                          <span class="bg-success-grediant">B</span>
                          <h6 class="ser-title">Bibliothèque de mes DVD (en cours)</h6>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="pills-creations-personnelles" role="tabpanel" aria-labelledby="pills-creations-personnelles-tab">
              <div class="py-5 service-24">
                <div class="container">
                  <div class="row wrap-service-24">

                    <div class="col-lg-3 col-md-6">
                      <div class="card rounded card-shadow border-0 mb-4">
                        <a href="javascript:void(0)" class="card-hover py-4 text-center d-block rounded">
                          <span class="bg-success-grediant">B</span>
                          <h6 class="ser-title">Création "bibliothèque" de mes DVD</h6>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="tab-pane fade" id="pills-creations-professionnelles" role="tabpanel" aria-labelledby="pills-creations-professionnelles-tab">
              <div class="py-5 service-24">
                <div class="container">
                  <div class="row wrap-service-24">

                    <div class="col-lg-3 col-md-6">
                      <div class="card rounded card-shadow border-0 mb-4">
                        <a href="javascript:void(0)" class="card-hover py-4 text-center d-block rounded">
                          <span class="bg-success-grediant">P</span>
                          <h6 class="ser-title">Portfolio (en cours)</h6>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- RECOMMANDATIONS -->
  <div class="container" id="recommandations">
    <div class="row">
      <div class="col-12">
        <div class="recommandationPro">
          <h4>Recommandations professionnelles <img src="./css/like.png" class="align-self-center" alt="logo like"></h4>

          <div class="row">
            <div class="affichageMessage col-lg-6 col-md-9 mt-5">
              
              <?php
              foreach ($messages as $message) {
                echo '<div>';
                echo '<u>' .'Le ' .$message['jour'] . '/' . $message['mois'] . '/' . $message['annee'] . '</u>' .'<br>';
                echo $message['prenom'] . ' ' . $message['nom'] . '<br>' . $message['metier'] . " de l'entreprise " . $message['entreprise'] . '<br>' . '"' . $message['message'] . '"' . '<hr>';
                echo '</div>';
              }
              ?>

            </div>
          </div>

          <div class="row">
          <div class="col-12 col-lg-7 col-md-6 boutonPC">
            <a class="btn btn-indigo" href="formRecommandation.php#formRecom" role="button">J'écris une recommandation</a>
          </div>

          </div>


        </div>
      </div>
    </div>
  </div>

  <!-- CONTACT -->
  <div class="container-fluid" id="contact">
    <div class="row">
      <div class="col-12 offset-md-1 col-md-6 formContact">
        <h4>Contact</h4>

        <form method="post" action="#contact">
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
            <small class="form-text text-muted">Votre adresse e-mail restera confidentielle.</small>
          </div>
          <div class="form-group">
            <label for="sujet">Sujet</label>
            <input type="text" class="form-control" name="sujet" id="sujet" placeholder="Sujet" maxlength="191" minlength="5" size="30" required>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" id="message" rows="3" placeholder="Veuillez entrer votre message" maxlength="1000" minlength="15" required></textarea>
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
            echo ("Merci de votre message !");
        }

          ?>

        </form>

      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-4">
        <p>Où me trouver: <br>
          Nantes (44)</p>
      </div>

      <div class="col-12 col-md-4">
        <a href="https://www.linkedin.com/in/lise-ravaud-dev-web" target="_blank"><img src="./css/iconeLK.png" class="icone" alt="Logo site Linkedin"></a>
      </div>
      <a class="btn btn-light btn-sm" href="#haut" role="button">Retour en haut du site</a>
    </div>
  </footer>

  <!-- BANDEAU MENTIONS LEGALES -->
  <div class="container-fluid">
    <div class="row mentionL">
      <div class="col-12 offset-md-2 col-md-6">
        <p>&copy; <?= date("Y") ?> Lise Ravaud | <a href="mentionsLegales.php#ml">Mentions légales</a></p>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <script>
    $(function() {
      $('nav a[href^="#"]').click(function() {
        var the_id = $(this).attr("href");
        if (the_id === '#') {
          return;
        }
        var positionCible = $(the_id).offset().top - 55
        $('html,body').animate({
          scrollTop: positionCible
        }, 'slow');
        return false;
      });
    })
  </script>

</body>

</html>