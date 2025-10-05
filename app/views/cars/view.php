<h2><?= htmlspecialchars($car['name']) ?></h2>

<p><strong>Kód:</strong> <?= htmlspecialchars($car['toy_code']) ?></p>
<p><strong>Szín:</strong> <?= htmlspecialchars($car['color']) ?></p>
<p><strong>Év:</strong> <?= htmlspecialchars($car['year']) ?></p>
<p><strong>Sorozat:</strong> <?= htmlspecialchars($car['series']) ?></p>
<p><strong>Tervező:</strong> <?= htmlspecialchars($car['designer_name']) ?></p>
<p><strong>Megjegyzés:</strong> <?= nl2br(htmlspecialchars($car['notes'])) ?></p>
<p><strong>Extrák:</strong> <?= nl2br(htmlspecialchars($car['extras'])) ?></p>
<p><strong>Csomagolt:</strong> <?= $car['packed'] ? 'Igen' : 'Nem' ?></p>

<?php if (!empty($car['img_url'])): ?>
    <p>
        <img src="image-proxy.php?url=<?= urlencode($car['img_url']) ?>" alt="<?= htmlspecialchars($car['name']) ?>" width="300">

    </p>
<?php endif; ?>

<p><a href="/?controller=cars&action=index">← Vissza a listához</a></p>
