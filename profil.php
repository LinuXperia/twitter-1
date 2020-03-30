<?php
    include('config/autoload.php');
    if(!isset($_SESSION['id'])) {
        header('Location: index.php');
    }

    if(empty($_GET['id']) || $_SESSION['id'] == $_GET['id']) {
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $created_at = $_SESSION['created_at'];
        $last_login = $_SESSION['last_login'];
    } else {
        $user = getUser($db, $_GET['id']);
        $id = $user['id'];
        $username = $user['username'];
        $created_at = $user['created_at'];
        $last_login = $user['last_login'];
    }

    $nbTweets = countTweets($db, $id);
?>
<!doctype>
<head>
    <meta charset="utf-8">
    <title><?php print $_SESSION['username'] ?>'s profile</title>
</head>
<html>
    <body>
        <h1>Profil de <?php print $username; ?></h1>
        <a href="home.php">Accueil</a>
        <p>Nom d'utilisateur : <?php print $username; ?></p>
        <p>Nombre de tweets : <?php print $nbTweets; ?> </p>
        <p>Création du profil : <?php echo date('d-m-Y H:i:s', strtotime($created_at)); ?></p>
        <p>Dernière connexion : <?php echo date('d-m-Y H:i:s', strtotime($last_login)); ?></p>
        <a href="editProfil.php">Modifier mon profil</a>
    </body>
</html>
