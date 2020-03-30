<?php
    include('config/autoload.php');

    if(isset($_POST['inscription']) && isset($_POST['username']) && isset($_POST['password'])) {
        register($db, $_POST['username'], $_POST['password']);
    }

    if(isset($_POST['connexion']) && isset($_POST['username']) && isset($_POST['password'])) {
        login($db, $_POST['username'], $_POST['password']);
    }

    if(isset($_SESSION['id'])) {
        header('Location: home.php');
    }

    if(isset($_GET['msg']) && $_GET['msg'] == 'errorUserExist') {
        echo 'User already exists.';
    }

    if(isset($_GET['msg']) && $_GET['msg'] == 'success') {
        echo 'Thank you for your registration! You can now login. :-)';
    }

    if(isset($_GET['msg']) && $_GET['msg'] == 'errorConnexion') {
        echo 'Wrong password, try again.';
    }
?>
<!doctype>
<head>
    <meta charset="utf-8">
    <title>Welcome to Twitter!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</head>
<html>
    <body id="index">
        <header>
            <h1><img src="assets/logo.png" alt="Twitter logo"></h1>
        </header>
        <div id="wrapper">
            <div id="sign-up">
                <h2>Vous inscrire</h2>
                <form action="index.php" method="post">
                    <input type="text" name="username" placeholder="Nom d'utilisateur">
                    <input type="password" name="password" placeholder="Mot de passe">
                    <input type="submit" name="inscription" value="Inscription">
                </form>
                <p>Vous avez déjà un compte ? <a href="#">Connectez-vous !</a></p>
            </div>

            <div id="login">
                <h2>Connectez vous !</h2>
                <form action="index.php" method="post">
                    <input type="text" name="username" placeholder="Nom d'utilisateur">
                    <input type="password" name="password" placeholder="Mot de passe">
                    <input type="submit" name="connexion" value="Connexion">
                </form>
                <p>Vous n'avez pas de compte ? <a href="#">Inscrivez-vous !</a></p>
            </div>
        </div>
    </body>
</html>