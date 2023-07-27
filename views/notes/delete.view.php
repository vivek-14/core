<form action="/note" method="POST" class="mt-6">
    <input type="hidden" name="_method" value="DELETE" />
    <input type="hidden" name="id" value="<?php echo $note['id'] ?>">
    <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Delete</button>
</form>