<?php require base_path("views/partials/head.php") ?>

<?php require base_path("./views/partials/navbar.php") ?>

<?php require base_path("./views/partials/header.php") ?>


<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <ul class="mb-6">
            <?php foreach ($notes as $note) : ?>

                <li>
                    <a href="note?id=<?= $note['id'] ?>" class="text-blue-500 hover:underline">
                        <?= htmlspecialchars($note['body']) ?>
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>
        <div>
            <a href="/note/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</a>
        </div>
    </div>
</main>


<?php require base_path("./views/partials/footer.php") ?>