<?php
    include('config/autoload.php');
    // session destroy
    session_destroy();
    header('Location: index.php');
?>