<?php

$router = new \Core\Router();

$router->get('/', 'indexController.php');
$router->get('/about', 'aboutController.php');
$router->get('/contact', 'contactController.php');

$router->get('/notes', 'notes/index.php')->only('auth');
$router->post('/notes', 'notes/store.php');

$router->get('/note', 'notes/show.php');
$router->patch('/note', 'notes/update.php');
$router->delete('/note', 'notes/destroy.php');
$router->get('/note/create', 'notes/create.php');
$router->get('/note/edit', 'notes/edit.php');

$router->get('/register', 'authentication/create.php')->only('guest');
$router->post('/register', 'authentication/store.php');

$router->get('/login', 'sessions/create.php')->only('guest');
$router->post('/login', 'sessions/store.php');

$router->delete('/logout', 'sessions/destroy.php')->only('auth');
