
<?php
require('php/config.php');
session_start();
$messageRegister = "";

if (isset($_POST['username'])){
    $username = stripslashes($_POST['username']);
    $email = stripslashes($_POST['email']);
    $password = stripslashes($_POST['password']);
    $passwordConfirm = stripslashes($_POST['retype_password']);

    if($password != $passwordConfirm){
        $messageRegister = "Le mot de passe et le mot de passe de confirmation sont différents";
    }else{
        $passwordCrypt = hash('sha256', $password);

        $sqlQuery = $db->prepare("INSERT INTO users(username,email,password) values(?,?,?)");

        $sqlQuery->execute([$username,$email,$passwordCrypt]);

        var_dump($sqlQuery);
        if($sqlQuery->rowCount() > 0){
            $messageRegister = "";
            header('Location: visualisation.php');
        }else{
            $messageRegister = "Erreur de création de compte";
        }
    }


}
?>


<!doctype html>
<html class="no-js" lang="en">
    
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> ModularAdmin - Free Dashboard Theme | HTML Version </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
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
                            </div> JD STORE </h1>
                    </header>
                    <div class="auth-content">
                        <p class="text-center">CREER UN COMPTE</p>
                        <form id="signup-form" action="" method="POST" novalidate="">
                            <center>
                                <label id="errorMessage" for="username"><?php echo $messageRegister; ?></label>
                            </center>
                            <div class="form-group">
                                <label for="firstname">Username</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control underlined" name="username" id="username" placeholder="Saisir le username" required=""> </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control underlined" name="email" id="email" placeholder="Saisir un email" required=""> </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control underlined" name="password" id="password" placeholder="Saisir un mot de passe" required=""> </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Confirmer le mot de passe</label>
                                <div class="row">

                                    <div class="col-sm-12">
                                        <input type="password" class="form-control underlined" name="retype_password" id="retype_password" placeholder="Resaisir le mot de passe" required=""> </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Valider</button>
                            </div>
                            <div class="form-group">
                                <p class="text-muted text-center">Vous avez déjà un compte?
                                    <a href="login.php">Connectez-vous!</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
<!--                <div class="text-center">-->
<!--                    <a href="brief-c\visualisation.html" class="btn btn-secondary btn-sm">-->
<!--                      <i class="fa fa-arrow-left"></i> Back to dashboard </a>-->
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