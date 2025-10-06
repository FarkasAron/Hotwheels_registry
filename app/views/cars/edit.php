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
        <label class="form-label">Szín</label>
        <input type="text" name="color_id" class="form-control" 
               value="<?= htmlspecialchars($car['color'] ?? '') ?>">
    </div>
    <div class="col-md-3">
        <label class="form-label">Év</label>
        <input type="text" name="year_id" class="form-control" 
               value="<?= htmlspecialchars($car['year'] ?? '') ?>">
    </div>
    <div class="col-md-3">
        <label class="form-label">Sorozat</label>
        <input type="text" name="series_id" class="form-control" 
               value="<?= htmlspecialchars($car['series'] ?? '') ?>">
    </div>
    <div class="col-md-3">
        <label class="form-label">Tervező</label>
        <input type="text" name="designer_id" class="form-control" 
               value="<?= htmlspecialchars($car['designer_name'] ?? '') ?>">
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
    <input type="hidden" name="id" value="<?= htmlspecialchars($car['id']) ?>">

</form>
