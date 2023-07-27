<?php

use Core\Session;
$title = 'Login Here';
view('sessions/create.view.php', [
    'title' => $title,
    'errors' =>  Session::get('errors')
]);