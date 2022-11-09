<div class="lg:grid lg:grid-cols-6">
    <?php foreach ($realestates as $realestate) : ?>
        <div class="p-6 col-span-2">
            <a href="estate?estate=<?= $realestate->getId(); ?>" class="text-md"><?= $realestate->getTitle(); ?></a>
            <img src="<?= $realestate->getImage(); ?>" alt="">
            <p class="text-sm"><?= $realestate->getDescription(); ?></p>
        </div>
    <?php endforeach; ?>
</div>