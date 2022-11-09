<?php require('partials/header.php'); ?>
<?php require('partials/homeLink.php') ?>

<form action="/login" method="POST" class="flex flex-col w-1/2 m-auto mt-10">
    <label class="text-sm mt-3" name="email">Email</label>
    <input class="rounded-md" type="email" name="email" id="email">

    <label class="text-sm mt-3" name="password">Password</label>
    <input class="rounded-md" type="password" name="password" id="password">

    <button class="mt-8 w-96 p-4 bg-gray-700 rounded-md m-auto text-white hover:bg-gray-900" type="submit" name="submit">Log in</button>
</form>

<?php foreach ($errors as $error) : ?>
    <p><?= $error; ?></p>
<?php endforeach; ?>

<?php require('partials/footer.php'); ?>