<div class="lg:grid lg:grid-cols-6">
    <?php foreach ($realestates as $realestate) : ?>
        <div class="p-6 col-span-2">
            <p class="text-md"><?= $realestate->title; ?></p>
            <img src="<?= $realestate->image; ?>" alt="">
            <p class="text-sm"><?= $realestate->description; ?></p>
        </div>
    <?php endforeach; ?>
</div>