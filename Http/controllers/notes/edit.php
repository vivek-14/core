<?php

$title = 'Edit Note';

use Core\Router;
use Core\App;
use Core\Database;


$db = App::resolve(Database::class);

$currentUserId = 1;
$note_id = $_GET['id'];

$note = $db->query('select * from notes where id = :id', ['id' => $note_id])->findOrFail();

if (!$note) {
    ROUTER::abort();
}

authorize($note['user_id'] === $currentUserId);


require view('/notes/edit.view.php', [
    'title' => $title,
    'note' => $note
]);
