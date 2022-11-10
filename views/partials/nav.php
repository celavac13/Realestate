<nav class="flex flex-row-reverse bg-gray-200 pt-4 pb-4 text-xl">
    <?php if ($this->getLoggedInUser()) : ?>
        <a class="mr-6 text-blue-500" href="/logout">Logout</a>
        <a class="mr-6 text-blue-500" href="/add-realestate">Add Realestate</a>
        <a class="mr-6 text-blue-500" href="/favourites">Favourites</a>
        <p class="mr-20">Welcome <?= $this->getLoggedInUser()->getUsername(); ?></p>
    <?php else : ?>
        <a class="mr-6" href="/login">Login</a>
        <a class="mr-20" href="/register">Register</a>
    <?php endif; ?>
</nav>