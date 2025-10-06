<div class="card mb-3">
    <div class="row g-0">
        <?php if ($car['img_url']): ?>
        <div class="col-md-4 d-flex justify-content-center">
            <img src="<?= htmlspecialchars($car['img_url']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($car['name']) ?>" >>
        </div>
        <?php endif; ?>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($car['name']) ?></h5>
                <p class="card-text"><strong>Kód:</strong> <?= htmlspecialchars($car['toy_code']) ?></p>
                <p class="card-text"><strong>Szín:</strong> <?= htmlspecialchars($car['color']) ?></p>
                <p class="card-text"><strong>Év:</strong> <?= htmlspecialchars($car['year']) ?></p>
                <p class="card-text"><strong>Sorozat:</strong> <?= htmlspecialchars($car['series']) ?></p>
                <p class="card-text"><strong>Tervező:</strong> <?= htmlspecialchars($car['designer_name']) ?></p>
                <p class="card-text"><strong>Megjegyzés:</strong> <?= nl2br(htmlspecialchars($car['notes'])) ?></p>
                <p class="card-text"><strong>Extrák:</strong> <?= nl2br(htmlspecialchars($car['extras'])) ?></p>
                <p class="card-text"><strong>Csomagolt:</strong> <?= $car['packed'] ? 'Igen' : 'Nem' ?></p>
                <a href="/?controller=cars&action=index" class="btn btn-secondary mt-2">← Vissza a listához</a>
            </div>
        </div>
    </div>
</div>
