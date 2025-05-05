<?php
// la 1ere fois les champs sont vide
    $firstname = $name = $email = $phone = $message = "";
    // POUR LES ERREURS
    $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
    $isSuccess = false;
    $emailTo = "sangarekabinet7@gmail.com";
    /* si c'est la 2em que user viens on rempli avec ce qu'il avait saisie
    * puis on verifie les saisies qu'il a faite
    *
    */
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $firstname = verifyInput($_POST["firstname"]);
        $name = verifyInput($_POST["name"]);
        $email = verifyInput($_POST["email"]);
        $phone = verifyInput($_POST["phone"]);
        $message = verifyInput($_POST["message"]);
        $isSuccess = true;
        $emailText = "";

        // VALIDATION COTE SERVEUR
        if(empty($firstname)) {
            $firstnameError = "Je veux connaitre ton prénom ! ";
            $isSuccess = false;
        }
        else
            $emailText .= "FirstName: $firstname\n";

        if(empty($name)) {
            $nameError = "Et oui je veux savoir ton nom aussi ! ";
            $isSuccess = false;
        }
        else
            $emailText .= "Name: $name\n";

        if(!isEmail($email)) {
            $emailError = " C'est pas un email ça ! ";
            $isSuccess = false;
        }
        else
            $emailText .= "Email: $email\n";

        if(!isPhone($phone)) {
            $phoneError = " Que des chiffres et des espaces stp ! ";
            $isSuccess = false;
        }
        else
            $emailText .= "Phone: $phone\n";

        if(empty($message)) {
            $messageError = "Qu'est-ce que tu veux me dire ! ";
            $isSuccess = false;
        }
        else
            $emailText .= "Message: $message\n";

        if( $isSuccess) {
            // envoie de l'email
            $headers = "From: $firstname $name <$email>\r\nReply-To: $email";
            mail($emailTo, "Un message de votre site", $emailText , $headers);
            $firstname = $name = $email = $phone = $message = "";

        }

    }

    function isEmail($var) {
        return filter_var($var, FILTER_VALIDATE_EMAIL) ;
    }

    function isPhone($var) {
        return preg_match("/^[0-9 ]*$/", $var);
    }

    // SECURISER LES ENTRER
    function verifyInput($var){
        $var = trim($var); // trim enleve les caractere qui sont pas accepter
        $var = stripcslashes($var); // enleve tout les slashes
        $var = htmlspecialchars($var); 

        return $var;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contactez-moi !</title>
    <link rel="stylesheet" href="css/styleContact.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>
<body>
<header>
        <nav class="navbar navbar-expand-md fixed-top" id="navigation">
            <div class="container">
                <div id="logo">
                    <a class="navbar-brand text-uppercase fw-bold" href="index.html">Thales SANGARE</a>
                </div>
    
                <!-- Bouton Toggler déplacé à droite -->
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav text-end">
                        <li class="nav-item">
                            <a href="docs/MonCv.pdf" class="nav-link">CV</a>
                        </li>
                        <li class="nav-item">
                            <a href="#section-titre-projet" class="nav-link">Projets</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


   <div class="container" id="Container-formulaire">
        <div class="divider"></div>
        <div class="heading">
            <h2 style="color: white"> Contactez-moi</h2>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <form id="contact-form" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>" method="post" role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname">Prénom <span class="blue"> *</span></label>
                            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Votre prénom" value="<?php echo $firstname; ?>" >
                            <p class="comments"><?php echo $firstnameError; ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="name">Nom <span class="blue"> *</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value="<?php echo $name; ?>" >
                            <p class="comments"><?php echo $nameError; ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="email">Email <span class="blue"> *</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" value="<?php echo $email; ?>" >
                            <p class="comments"><?php echo $emailError; ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre téléphone" value="<?php echo $phone; ?>" >
                            <p class="comments"><?php echo $phoneError; ?></p>
                        </div>
                        <div class="col-md-12">
                            <label for="message">Message <span class="blue"> *</span></label>
                            <textarea id="message" name="message" class="form-control" placeholder="Votre message" rows="4"><?php echo $message; ?> </textarea>
                            <p class="comments"><?php echo $messageError; ?></p>
                        </div>

                        <div class="col-md-12">
                            <p class="blue"><strong> * Ces informations sont requises</strong></p>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" class="button1" value="Envoyer">
                        </div>


                    </div>

                    <p class="thank-you" style="display: <?php if($isSuccess) echo 'block'; else echo 'none'; ?>">Votre message a bien ete envoyé. Merci de m'avoir contacté </p>
                </form>

            </div>
        </div>


   </div>

   <footer class="border-top" id="footer">
        <div class="container py-5" id="section-footer">
            <div class="row text-center text-sm-start">
                <!-- Section Contact -->
                <div class="col-12 col-sm-4 mb-4">
                    <h3 class="fw-bold">Contact</h3>
                    <ul class="list-unstyled">
                        <li><a href="mailto:sangarekabinet7@gmail.com">sangarekabinet7@gmail.com</a></li>
                        <li><a href="tel:+32466186924">+32 466 186 924</a></li>
                        <li><a href="https://www.instagram.com/i.am_thales7/" target="_blank">Instagram</a></li>
                        <li><a href="https://github.com/tonprofil" target="_blank">GitHub</a></li>
                    </ul>
                </div>
    
                <!-- Section Navigation -->
                <div class="col-12 col-sm-4 mb-4">
                    <h3 class="fw-bold">Navigation</h3>
                    <ul class="list-unstyled">
                        <li><a href="#section-premier">CV</a></li>
                        <li><a href="#section-titre-projet">Projets</a></li>
                        <li><a href="#footer">Contact</a></li>
                    </ul>
                </div>
    
                <!-- Section Suivez-moi -->
                <div class="col-12 col-sm-4 mb-4">
                    <h3 class="fw-bold">Suivez-moi</h3>
                    <p>Mes réseaux sociaux</p>
                    <div class="d-flex justify-content-center justify-content-sm-start gap-3" id="icones-footer">
                        <a href="http://m.facebook.com/kabinet.sangare.1" target="_blank">
                            <i class="fa-brands fa-facebook fa-2x"></i>
                        </a>
                        <a href="https://www.instagram.com/i.am_thales7/" target="_blank">
                            <i class="fa-brands fa-instagram fa-2x"></i>
                        </a>
                        <a href="https://discord.gg/i_am_thales" target="_blank">
                            <i class="fa-brands fa-discord fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Section Copyright -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; Décembre 2024 Thales - Tous droits réservés</p>
                </div>
            </div>
        </div>
    </footer>


</body>
</html>