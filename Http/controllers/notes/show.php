<?php

use Core\Router;
use Core\App;
use Core\Database;


$db = App::resolve(Database::class);


$title = "Note";
$note_id = $_GET['id'];
$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', ['id' => $note_id])->findOrFail();

if (!$note) {
    Router::abort();
}

authorize($note['user_id'] === $currentUserId);

view("notes/show.view.php", [
    'title' => $title,
    'note' => $note
]);
