<?php require base_path("views/partials/head.php") ?>

<?php require base_path("./views/partials/navbar.php") ?>

<?php require base_path("./views/partials/header.php") ?>


<main>

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p><?= htmlspecialchars($note['body']) ?></p>

        <form action="/note/edit" method="GET" class="mt-6">
            <input type="hidden" name="id" value="<?php echo $note['id'] ?>">
            <a href="<?= "/notes" ?>" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded">Go Back..</a>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Edit</button>
        </form>
    </div>
</main>


<?php require base_path("./views/partials/footer.php") ?>