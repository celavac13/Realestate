<?php if (isset($_SESSION['user']['username'])) : ?>
    <div class="p-6 col-span-2">
        <input type="hidden" id="userId" data-value="<?= $_SESSION['user']['id']; ?>" />
        <input type="hidden" id="realestateId" data-value="<?= $realestate->id; ?>" />
        <p class="text-xl"><?= $realestate->title; ?></p>
        <img src="<?= $realestate->image; ?>" alt="">
        <p class="text-md"><?= $realestate->description; ?></p>
        <i class="fa fa-heart <?= $isFavourite ? "liked" : "" ?>" id="likeBtn" style="font-size:48px;"></i>
        <p class="text-md" id="successMsg"></p>
    </div>

<?php else : ?>
    <div class="p-6 col-span-2">
        <p class="text-xl"><?= $realestate->title; ?></p>
        <img src="<?= $realestate->image; ?>" alt="">
        <p class="text-md"><?= $realestate->description; ?></p>
    </div>
<?php endif; ?>