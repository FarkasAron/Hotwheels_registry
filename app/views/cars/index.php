<h2>Autók listája</h2>

<form method="get" action="">
    <input type="hidden" name="controller" value="cars">
    <input type="hidden" name="action" value="index">
    <input type="text" name="search" placeholder="Keresés név vagy kód alapján" value="<?= htmlspecialchars($keyword ?? '') ?>">
    <button type="submit">Keresés</button>
    <a href="/?controller=cars&action=create">+ Új autó hozzáadása</a>
</form>

<table border="1" cellpadding="5">
    <tr>
        <th>Név</th>
        <th>Kód</th>
        <th>Szín</th>
        <th>Év</th>
        <th>Sorozat</th>
        <th>Tervező</th>
        <th>Kép</th>
        <th>Műveletek</th>
    </tr>
    <?php if (!empty($cars)): ?>
        <?php foreach ($cars as $car): ?>
        <tr>
            <td><?= htmlspecialchars($car['name']) ?></td>
            <td><?= htmlspecialchars($car['toy_code']) ?></td>
            <td><?= htmlspecialchars($car['color']) ?></td>
            <td><?= htmlspecialchars($car['year']) ?></td>
            <td><?= htmlspecialchars($car['series']) ?></td>
            <td><?= htmlspecialchars($car['designer']) ?></td>
            <td>
                <?php if ($car['img_url']): ?>
                    <img src="<?= htmlspecialchars($car['img_url']) ?>" alt="<?= htmlspecialchars($car['name']) ?>" width="80">
                <?php endif; ?>
            </td>
            <td>
                <a href="/?controller=cars&action=view&id=<?= $car['id'] ?>">Megnéz</a> |
                <a href="/?controller=cars&action=edit&id=<?= $car['id'] ?>">Szerkeszt</a> |
                <a href="/?controller=cars&action=delete&id=<?= $car['id'] ?>" onclick="return confirm('Biztos törlöd?')">Töröl</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="8">Nincs találat.</td></tr>
    <?php endif; ?>
</table>
