<?php if ($loggedInUser) : ?>
    <div class="flex items-start">
        <div class="p-6 col-span-2">
            <input type="hidden" id="userId" data-value="<?= $loggedInUser->getId(); ?>" />
            <input type="hidden" id="realestateId" data-value="<?= $realestate->getId(); ?>" />
            <p class="text-xl"><?= $realestate->getTitle(); ?></p>
            <img src="<?= $realestate->getImage(); ?>" alt="">
            <p class="text-md"><?= $realestate->getDescription(); ?></p>
            <i class="fa fa-heart <?= $isFavourite ? "liked" : "" ?>" id="likeBtn" style="font-size:48px;"></i>
            <p class="text-md" id="successMsg"></p>
        </div>
        <?php if ($loggedInUser->getId() === $realestate->getUserId()) : ?>
            <a href="/edit?estate=<?= $realestate->getId(); ?>" class="text-blue-500 text-xl ml-10 mt-10 hover:text-blue-800">Edit</a>
        <?php endif; ?>
    </div>

<?php else : ?>
    <div class="p-6 col-span-2">
        <p class="text-xl"><?= $realestate->getTitle(); ?></p>
        <img src="<?= $realestate->getImage(); ?>" alt="">
        <p class="text-md"><?= $realestate->getDescription(); ?></p>
    </div>
<?php endif; ?>