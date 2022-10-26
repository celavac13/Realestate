<?php require('app/views/partials/header.php'); ?>

<form action="/add-realestate" method="POST" class="flex flex-col w-1/2 m-auto mt-10" enctype="multipart/form-data">
    <label class="text-sm mt-3" name="estate" for="">Select Estate</label>
    <select class="rounded-md p-2" name="estate" id="estate">
        <?php foreach ($cities as $city) : ?>
            <option value="<?= $city->id; ?>"><?= $city->name; ?></option>
        <?php endforeach; ?>
    </select>

    <label class="text-sm mt-3" name="title">Title</label>
    <input class="rounded-md" type="text" name="title" id="title">

    <label class="text-sm mt-3" name="description">Description</label>
    <textarea class="rounded-md p-2" name="description" id="description"> </textarea>

    <label class="text-sm mt-3" name="price">Price</label>
    <input class="rounded-md" type="text" name="price" id="price">

    <label class="text-sm mt-3" name="image">Image</label>
    <input class="rounded-md" type="file" name="image" id="image">

    <button class="mt-8 w-96 p-4 bg-gray-700 rounded-md m-auto text-white hover:bg-gray-900" type="submit" name="submit">Add Realestate</button>
</form>

<?php require('app/views/partials/footer.php'); ?>