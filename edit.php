<?php
    include('config/autoload.php');
    if(!isset($_SESSION['id'])){
        header('Location: index.php');
    }
    if(!isset($_GET['id'])) {
        header('Location: home.php');
    }
    
    $tweet = getTweet($db, $_GET['id']);
    if($tweet['author_id'] != $_SESSION['id']) {
        header('Location: home.php');
    }
    
    if(isset($_POST['tweet']) && strlen($_POST['tweet']) <= 120) {
        updateTweet($db, $_GET['id'], $_POST['tweet']);
        header('Location: home.php');
    }
?>
<!doctype>
<head>
    <meta charset="utf-8">
    <title>Modify your tweet</title>
</head>
<html>
    <body>
        <form action="edit.php?id=<?php print $_GET['id']; ?>" method="post">
            <input type="text" name="tweet" value="<?php print $tweet['tweet']; ?>" placeholder="tweet">
            <input type="submit">
        </form>
    </body>
</html>
