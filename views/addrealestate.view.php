<?php require('partials/header.php'); ?>

<?php require('partials/homeLink.php') ?>

<form action="/add-realestate" method="POST" class="flex flex-col w-1/2 m-auto mt-10" enctype="multipart/form-data">
    <label class="text-sm mt-3" name="estate" for="">Select City</label>
    <select class="rounded-md p-2" name="estate" id="estate" required>
        <?php foreach ($cities as $city) : ?>
            <option value="<?= $city->getId(); ?>"><?= $city->getName(); ?></option>
        <?php endforeach; ?>
    </select>

    <label class="text-sm mt-3" name="title">Title</label>
    <input class="rounded-md" type="text" name="title" id="title">

    <label class="text-sm mt-3" name="description">Description</label>
    <textarea class="rounded-md p-2" name="description" id="description" required> </textarea>

    <label class="text-sm mt-3" name="price">Price</label>
    <input class="rounded-md" type="text" name="price" id="price" required>

    <label class="text-sm mt-3" name="image">Image</label>
    <input class="rounded-md" type="file" name="image" id="image" required>

    <button class="mt-8 w-96 p-4 bg-gray-700 rounded-md m-auto text-white hover:bg-gray-900" type="submit" name="submit">Add Realestate</button>
</form>

<?php foreach ($errors as $error) : ?>
    <p><?= $error; ?></p>
<?php endforeach; ?>

<?php require('partials/footer.php'); ?>