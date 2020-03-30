<?php

function register($db, $username, $password) {
    $check = $db->prepare('SELECT * FROM users WHERE username = :username');

    $check->execute(array(
       ':username' => $username
    ));

    if($userExist = $check->fetch()) {
        // if the function responds with true that means the user exists

        header('Location: index.php?msg=errorUserExist');
    } else {
        // if the function doesn't respond with anything that means the user doesn't exist
        // that means we're free to add the user in the database

        $insert = $db->prepare('INSERT INTO users (username, password, created_at, last_login) VALUES (:username, :password, :created_at, :last_login)');

        $insert->execute(array(
           ':username'   => $username,
           ':password'   => sha1($password),
           ':created_at' => date('Y-m-d H:i:s'),
           ':last_login' => date('Y-m-d H:i:s')
        ));
        header('Location: index.php?msg=success');
    }
}

function login($db, $username, $password) {
    $check = $db->prepare('SELECT * FROM users WHERE username = :username');

    $check->execute(array(
       ':username' => $username
    ));

    if($userExist = $check->fetch()) {
        // if the function responds with true that means the user exists
        // let's now check the password see if it matches the one stored in the database

        if($userExist['password'] == sha1($password)) {
            // user is online, updating the "last_login" column in the database
            $update = $db->prepare('UPDATE users SET last_login = :last_login WHERE id = :id');

            $update->execute(array(
               ':last_login' => date('Y-m-d H:i:s'),
               ':id'         => $userExist['id']
            ));

            // we now initiate the sessions
            $_SESSION['id'] = $userExist['id'];
            $_SESSION['username'] = $userExist['username'];
            $_SESSION['created_at'] = $userExist['created_at'];
            $_SESSION['last_login'] = $userExist['last_login'];
        } else {
            header('Location: index.php?msg=errorConnexion');
        }
    } else {
        header('Location: index.php?msg=errorConnexion');
    }
}

function countTweets($db, $userId) {
    $req = $db->prepare('SELECT * FROM tweets WHERE author_id = :id');

    $req->execute(array(
       ':id' => $userId
    ));

    return $req->rowCount();
}

function getUser($db, $userId) {
    $req = $db->prepare('SELECT id, username, image, last_login, created_at FROM users WHERE id = :id');

    $req->execute(array(
       ':id' => $userId
    ));

    return $req->fetch();
}

function setUsername($db, $userId, $username) {
    // checking if the username is already taken
    $check = $db->prepare('SELECT * FROM users WHERE username = :username');

    $check->execute(array(
       ':username' => $username
    ));

    if($check->fetch()) {
        // username is already taken
        return false;
    } else {
        // username isn't taken
        $update = $db->prepare('UPDATE users SET username = :username WHERE id = :id');

        $update->execute(array(
           ':username' => $username,
           ':id'       => $userId
        ));
        // new session
        $_SESSION['username'] = $username;
        header('Location: editProfil.php?msg=usernameChanged');
    }
}

function setPassword($db, $userId, $password) {
    $update = $db->prepare('UPDATE users SET password = :password WHERE id = :id');

    $update->execute(array(
       ':password' => sha1($password),
       ':id'       => $userId
    ));
    header('Location: editProfil.php?msg=passwordChanged');
}

function setImage($db, $userId, $file) {
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strchr($file['name'], '.');

    if(!in_array($extension, $extensions)) {
        header('Location: editProfil.php?msg=wrongExtension');
    } else {
        header('Location: editProfil.php?msg=imgChanged');
    }

    $maxsize = 1000000;
    $size = filesize($file['tmp_name']);

    if($size>$maxsize) {
        header('Location: editProfil.php?msg=tooBig');
        return false;
    }

    $dossier = 'assets/uploads/';
    $fichier = basename($file['name']);

    if(move_uploaded_file($file['tmp_name'], $dossier . $fichier)) {
        $req =$db->prepare('UPDATE users SET image = :image WHERE id = :id');

        $req->execute(array(
           ':image' => $file['name'],
           ':id'    => $userId
        ));
    }
}