<?php

use Core\Router;
use Core\App;
use Core\Database;


$db = App::resolve(Database::class);

$currentUserId = 1;
$note_id = $_POST['id'];

$note = $db->query('select * from notes where id = :id', ['id' => $note_id])->findOrFail();

if (!$note) {
    ROUTER::abort();
}

authorize($note['user_id'] === $currentUserId);

$db->query('DELETE FROM notes WHERE id = :id', [
    'id' => $_POST['id']
]);

header('location: /notes');
