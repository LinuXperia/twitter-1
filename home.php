<?php
    include('config/autoload.php');
    if(!isset($_SESSION['id'])){
        header('Location: index.php');
    }
    if(isset($_POST['tweet'])) {
        if(strlen($_POST['tweet']) <= 120) {
            addTweet($db, $_POST['tweet'], $_SESSION['id']);
            header('Location: home.php');
        } else {
            $error = "Le tweet est trop long.";
        }
    }
?>
<!doctype>
<head>
    <meta charset="utf-8">
    <title>Welcome to Twitter!</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<html>
    <body id="home">
        <header>
            <h1><img src="assets/logo.png" alt="Twitter logo"></h1>
            <form action="home.php" method="post">
                <input type="text" name="tweet" placeholder="Votre tweet">
                <input type="submit">
            </form>
        </header>
        <div id="wrapper">
                <h2>Tous les tweets</h2>
                <ul>
                    <?php foreach(showAllTweets($db) as $tweet): ?>
                        <li>
                            <?php print $tweet['tweet']; ?> -
                            <?php print $tweet['username']; ?> -
                            <?php echo date('d-m-Y \a\ H:i:s', strtotime($tweet['created_at'])); ?>
                            <?php if($tweet['author_id'] == $_SESSION['id']) : ?>
                                | <a href="edit.php?id=<?php print $tweet['id']; ?>">Modifier</a>
                                | <a href="delete.php?id=<?php print $tweet['id']; ?>">Supprimer</a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <h2>Gestion du profil</h2>
                <a href="profil.php">Voir mon profil</a>
                <a href="logout.php">Se déconnecter</a>
        </div>
    </body>
</html>