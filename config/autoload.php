<?php

session_start();

require('config.php');

require('functions/database.fn.php');

require('functions/tweet.fn.php');

require('functions/user.fn.php');

// DB connection

$db = getPDO($database);

?>