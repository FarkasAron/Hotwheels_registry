<h2>Autók listája</h2>

<!-- Keresőmező -->
<form method="get" action="" class="row g-3 mb-4">
    <input type="hidden" name="controller" value="cars">
    <input type="hidden" name="action" value="index">
    <div class="col-md-10">
        <input type="text" name="q" class="form-control" 
               placeholder="Keresés név vagy kód alapján..." 
               value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Keresés</button>
    </div>
</form>

<div class="table-responsive">
<table class="table table-striped table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Név</th>
            <th>Kód</th>
            <th>Szín</th>
            <th>Év</th>
            <th>Sorozat</th>
            <th>Tervező</th>
            <th>Megjegyzés</th>
            <th>Extrák</th>
            <th>Csomagolt</th>
            <th>Kép</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($cars)): ?>
        <?php foreach ($cars as $car): ?>
            <tr>
                <td><?= htmlspecialchars($car['name']) ?></td>
                <td><?= htmlspecialchars($car['toy_code']) ?></td>
                <td><?= htmlspecialchars($car['color']) ?></td>
                <td><?= htmlspecialchars($car['year']) ?></td>
                <td><?= htmlspecialchars($car['series']) ?></td>
                <td><?= htmlspecialchars($car['designer'] ?? '') ?></td>
                <td><?= nl2br(htmlspecialchars($car['notes'])) ?></td>
                <td><?= nl2br(htmlspecialchars($car['extras'])) ?></td>
                <td><?= $car['packed'] ? 'Igen' : 'Nem' ?></td>
                <td>
                    <?php if ($car['img_url']): ?>
                        <img src="<?= htmlspecialchars($car['img_url']) ?>" 
                             alt="<?= htmlspecialchars($car['name']) ?>" 
                             class="img-thumbnail" style="max-width:80px;">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/?controller=cars&action=view&id=<?= $car['id'] ?>" class="btn btn-sm btn-info">👁</a>
                    <a href="/?controller=cars&action=edit&id=<?= $car['id'] ?>" class="btn btn-sm btn-warning">✏</a>
                    <a href="/?controller=cars&action=delete&id=<?= $car['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Biztos törlöd?')">🗑</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="11" class="text-center">Nincs találat.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</div>
