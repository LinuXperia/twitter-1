<?php
function getPDO(array $config) {
    try {
        return $db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['database'], $config['username'],
            $config['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    } catch (Exception $e) {
        /* Sends an email in case there's an issue on the website */
        mail('johann.zitouni@gmail.com', 'Erreur sur le site', $e->getMessage());
        header('Location: 404.html');
    }
}
?>