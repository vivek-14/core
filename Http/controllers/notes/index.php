<?php

use Core\App;
use Core\Database;

$title = "Notes";

$db = App::resolve(Database::class);

$notes = $db->query('select * from notes')->findAll();

view("notes/index.view.php", [
    'title' => $title,
    'notes' => $notes
]);
