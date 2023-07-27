<?php
use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

// Check & get db Connection
$db = APP::resolve(Database::class);

// Fetch fields
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Validate fields
$form = new LoginForm($attr = [
    'email' => $email,
    'password' => $password
]);

if(! $form->validate($attr)) {
    view('authentication/create.view.php', [
        'email' => $email,
        'errors' => $form->errors()
    ]);
}

// check if email exists
$user = $db->query("Select * From users Where email = :email", [
    'email' => $email
])->find();

if($user) {
    $errors['email'] = 'Email already exists';
} else {
    $db->query('INSERT INTO users(email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    header('Location: /');
    exit();
}

if(!empty($errors)) {
    view('authentication/create.view.php', [
        'email' => $email,
        'errors' => $errors
    ]);
}
