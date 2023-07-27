<?php
// Log user out
use Core\Authenticator;

$auth = new Authenticator();
$auth->logout();
header('Location: /');
exit();