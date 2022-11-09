<?php if (isset($_SESSION['user']['username'])) : ?>
    <div class="p-6 col-span-2">
        <input type="hidden" id="userId" data-value="<?= $_SESSION['user']['id']; ?>" />
        <input type="hidden" id="realestateId" data-value="<?= $realestate->getId(); ?>" />
        <p class="text-xl"><?= $realestate->getTitle(); ?></p>
        <img src="<?= $realestate->getImage(); ?>" alt="">
        <p class="text-md"><?= $realestate->getDescription(); ?></p>
        <i class="fa fa-heart <?= $isFavourite ? "liked" : "" ?>" id="likeBtn" style="font-size:48px;"></i>
        <p class="text-md" id="successMsg"></p>
    </div>

<?php else : ?>
    <div class="p-6 col-span-2">
        <p class="text-xl"><?= $realestate->getTitle(); ?></p>
        <img src="<?= $realestate->getImage(); ?>" alt="">
        <p class="text-md"><?= $realestate->getDescription(); ?></p>
    </div>
<?php endif; ?>