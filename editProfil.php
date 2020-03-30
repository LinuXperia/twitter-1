<?php
    include('config/autoload.php');
    if(!isset($_SESSION['id'])) {
        header('Location: index.php');
    }

    // edit profile
    if (isset($_POST['username'])) {
        setUsername($db, $_SESSION['id'], $_POST['username']);
    }

    if (isset($_POST['password'])) {
        setPassword($db, $_SESSION['id'], $_POST['password']);
    }

    if (isset($_FILES['image'])) {
        $img = setImage($db, $_SESSION['id'], $_FILES['image']);
    }

    if(isset($_GET['msg']) && $_GET['msg'] == 'usernameChanged') {
        echo 'Your username was successfully changed.';
    }

    if(isset($_GET['msg']) && $_GET['msg'] == 'passwordChanged') {
        echo 'Your password was successfully changed.';
    }

    if(isset($_GET['msg']) && $_GET['msg'] == 'imgChanged') {
        echo 'Your profile picture was successfully changed.';
    }

    if(isset($_GET['msg']) && $_GET['msg'] == 'wrongExtension') {
        echo 'Please upload a file with any of the following extensions : .png, .gif, .jpg, .jpeg';
    }
?>

<!doctype>
<head>
    <meta charset="utf-8">
    <title>Edit your profile</title>
</head>
<html>
    <body>
        <h1>Modifier votre profil</h1>
        <form action="editProfil.php" method="post" enctype="multipart/form-data">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" value="<?php print $_SESSION['username']; ?>">
            <input type="submit">
        </form>
        <form action="editProfil.php" method="post" enctype="multipart/form-data">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" placeholder="À ne changer qu'en cas de besoin">
            <input type="submit">
        </form>
        <form action="editProfil.php" method="post" enctype="multipart/form-data">
            <label for="image">Image de profil</label>
            <input type="file" name="image">
            <input type="submit">
        </form>
        <a href="profil.php">Revenir à mon profil</a>
    </body>
</html>
