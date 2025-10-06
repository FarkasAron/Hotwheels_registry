<h2>Autó szerkesztése</h2>

<form method="post" action="" class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Név</label>
        <input type="text" name="name" class="form-control" 
               value="<?= htmlspecialchars($car['name'] ?? '') ?>" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Kód</label>
        <input type="text" name="toy_code" class="form-control" 
               value="<?= htmlspecialchars($car['toy_code'] ?? '') ?>">
    </div>
    <div class="col-md-3">
        <label class="form-label">Szín ID</label>
        <input type="number" name="color_id" class="form-control" 
               value="<?= htmlspecialchars($car['color_id'] ?? '') ?>">
    </div>
    <div class="col-md-3">
        <label class="form-label">Év ID</label>
        <input type="number" name="year_id" class="form-control" 
               value="<?= htmlspecialchars($car['year_id'] ?? '') ?>">
    </div>
    <div class="col-md-3">
        <label class="form-label">Sorozat ID</label>
        <input type="number" name="series_id" class="form-control" 
               value="<?= htmlspecialchars($car['series_id'] ?? '') ?>">
    </div>
    <div class="col-md-3">
        <label class="form-label">Tervező ID</label>
        <input type="number" name="designer_id" class="form-control" 
               value="<?= htmlspecialchars($car['designer_id'] ?? '') ?>">
    </div>
    <div class="col-12">
        <label class="form-label">Megjegyzés</label>
        <textarea name="notes" class="form-control"><?= htmlspecialchars($car['notes'] ?? '') ?></textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Extrák</label>
        <textarea name="extras" class="form-control"><?= htmlspecialchars($car['extras'] ?? '') ?></textarea>
    </div>
    <div class="col-12 form-check">
        <input type="checkbox" name="packed" value="1" class="form-check-input" id="packed" 
               <?= !empty($car['packed']) ? 'checked' : '' ?>>
        <label for="packed" class="form-check-label">Csomagolt</label>
    </div>
    <div class="col-12">
        <label class="form-label">Kép URL</label>
        <input type="text" name="img_url" class="form-control" 
               value="<?= htmlspecialchars($car['img_url'] ?? '') ?>">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-warning">Mentés</button>
        <a href="/?controller=cars&action=index" class="btn btn-secondary">Mégse</a>
    </div>
</form>
