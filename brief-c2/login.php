
<?php
require('php/config.php');
session_start();
$messageConnexion = "";

if (isset($_POST['email'])){
    $email = stripslashes($_POST['email']);
    $_SESSION['username'] = $email;
    $password = stripslashes($_POST['password']);

    $sqlQuery = $db->prepare("SELECT * FROM users WHERE email=? and password=?");
    $passwordCrypt = hash('sha256', $password);

    $sqlQuery->execute([$email,$passwordCrypt]);

    $passwordCrypt = hash('sha256', $password);

    if($sqlQuery->rowCount() > 0){
        $messageConnexion = "";
        header('Location: index.html');
    }else{
        $messageConnexion = "Les informations saisies sont incorrectes";
    }
}
?>


<!doctype html>
<html class="no-js" lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> ModularAdmin - Free Dashboard Theme | HTML Version </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <link rel="stylesheet" href="css/styles.css">
        <!-- Theme initialization -->
        <script>
            var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {};
            var themeName = themeSettings.themeName || '';
            if (themeName)
            {
                document.write('<link rel="stylesheet" id="theme-style" href="css/app-' + themeName + '.css">');
            }
            else
            {
                document.write('<link rel="stylesheet" id="theme-style" href="css/app.css">');
            }
        </script>
    </head>
    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title">
                            <div class="logo">
                                <span class="l l1"></span>
                                <span class="l l2"></span>
                                <span class="l l3"></span>
                                <span class="l l4"></span>
                                <span class="l l5"></span>
                            </div> ModularAdmin </h1>
                    </header>
                    <div class="auth-content">
                        <p class="text-center">CONNECTEZ-VOUS POUR CONTINUER</p>
                        <form id="login-form" action="" method="POST" novalidate="">
                            <center>
                                <label id="errorMessage" for="username"><?php echo $messageConnexion; ?></label>
                            </center>
                            <div class="form-group">
                                <label for="username">Email</label>
                                <input type="email" class="form-control underlined" name="email" id="email" placeholder="Saisir votre adresse mail" required> </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" class="form-control underlined" name="password" id="password" placeholder="Saisir votre mot de passe" required> </div>
                            <div class="form-group">

                                <a href="reset.html" class="forgot-btn pull-right">Mot de passe oublié?</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Se connecter</button>
                            </div>
                            <div class="form-group">
                                <p class="text-muted text-center">Vous avez déjà un compte?
                                    <a href="signup.php">Créer un compte!</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
<!--                <div class="text-center">-->
<!--                    <a href="brief-c\visualisation.html" class="btn btn-secondary btn-sm">-->
<!--                        <i class="fa fa-arrow-left"></i> Back to dashboard </a>-->
<!--                </div>-->
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script>
            (function(i, s, o, g, r, a, m)
            {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function()
                {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '../../www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-80463319-4', 'auto');
            ga('send', 'pageview');
        </script>
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>

</html>