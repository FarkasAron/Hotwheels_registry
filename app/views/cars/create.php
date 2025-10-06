<h2>Új autó hozzáadása</h2>

<form method="post" action="" class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Név</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Kód</label>
        <input type="text" name="toy_code" class="form-control">
    </div>
    <div class="col-md-3">
    <label class="form-label">Szín</label>
    <input type="text" name="color" class="form-control" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Év</label>
        <input type="text" name="year" class="form-control" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Sorozat</label>
        <input type="text" name="series" class="form-control" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Tervező</label>
        <input type="text" name="designer" class="form-control" required>
    </div>

    <div class="col-12">
        <label class="form-label">Megjegyzés</label>
        <textarea name="notes" class="form-control"></textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Extrák</label>
        <textarea name="extras" class="form-control"></textarea>
    </div>
    <div class="col-12 form-check">
        <input type="checkbox" name="packed" value="1" class="form-check-input" id="packed">
        <label for="packed" class="form-check-label">Csomagolt</label>
    </div>
    <div class="col-12">
        <label class="form-label">Kép URL</label>
        <input type="text" name="img_url" class="form-control">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-success">Mentés</button>
        <a href="/?controller=cars&action=index" class="btn btn-secondary">Mégse</a>
    </div>
</form>
