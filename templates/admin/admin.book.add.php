<?php include __DIR__ . '/../parts/header.php'; ?>

<div class="row align-items-center title">
    <div class="col">
        <h2 class="pb-3 mt-4"><?= $title ?></h2>
    </div>
</div>

<div class="row mb-5">
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 p-3 d-flex align-items-center" style="flex-direction: column">
        <form style="width: 100%" action="/admin/book/add" method="post">

            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" name="name" class="form-control <?php if ($errors['name']) { echo 'is-invalid'; } ?>"
                       id="name" aria-describedby="name"
                       placeholder="Enter name" value="<?= $_POST['name'] ?? '' ?>" required>
                <?php if ($errors['name']): ?>
                <div class="invalid-feedback">
                    <?= $errors['name'] ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="price">Price *</label>
                <input type="text" name="price" class="form-control <?php if ($errors['price']) { echo 'is-invalid'; } ?>"
                       id="price" aria-describedby="price"
                       placeholder="$ 0.00" value="<?= $_POST['price'] ?? '' ?>" required>
                <?php if ($errors['price']): ?>
                    <div class="invalid-feedback">
                        <?= $errors['price'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="poster">Poster url</label>
                <input type="text" name="poster" class="form-control <?php if ($errors['poster']) { echo 'is-invalid'; } ?>"
                       id="poster" aria-describedby="poster"
                       placeholder="Poster url" value="<?= $_POST['poster'] ?? '' ?>">
                <?php if ($errors['poster']): ?>
                    <div class="invalid-feedback">
                        <?= $errors['poster'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" name="url" class="form-control <?php if ($errors['url']) { echo 'is-invalid'; } ?>"
                       id="url" aria-describedby="url"
                       placeholder="Poster url" value="<?= $_POST['url'] ?? '' ?>">
                <?php if ($errors['url']): ?>
                    <div class="invalid-feedback">
                        <?= $errors['url'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN *</label>
                <input type="text" name="isbn" class="form-control <?php if ($errors['isbn']) { echo 'is-invalid'; } ?>"
                       id="isbn" aria-describedby="isbn"
                       placeholder="Enter ISBN: 10 symbols" value="<?= $_POST['isbn'] ?? '' ?>" minlength="10" maxlength="10" required>
<!--                <small id="max" class="form-text text-muted" style="text-align: end"><span id="count">0</span> / 10</small>-->
                <?php if ($errors['isbn']): ?>
                    <div class="invalid-feedback">
                        <?= $errors['isbn'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="tags">Tags *</label>
                <select multiple name="tags[]" class="form-control <?php if ($errors['tags']) { echo 'is-invalid'; } ?>"
                        id="tags" required>
                    <?php if ($tags[0]): ?>
                        <?php foreach ($tags as $tag): ?>
                            <option value="<?= $tag->id ?>"><?= $tag->name ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add book</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../parts/footer.php'; ?>