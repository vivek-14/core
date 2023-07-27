<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

// Fetch fields
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Validate fields
$form = LoginForm::validate($attributes = [
    'email' => $email,
    'password' => $password
]);

$signedIn = (new Authenticator)->attempt($attributes['email'], $attributes['password']);
// Authenticate user
if(!$signedIn) {
    $form->error(
        'auth', 'no matching account found'
    )->throw();

}

redirect('/');





