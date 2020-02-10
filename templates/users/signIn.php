<?php include __DIR__ . '/../parts/header.php'; ?>

    <div class="row align-items-center title">
        <div class="col">
            <h2 class="pb-3 mt-4"><?= $title ?></h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 p-3 d-flex align-items-center" style="flex-direction: column">
            <?php if ($error): ?>
            <div class="alert alert-danger" style="width: 100%" role="alert"><?= $error ?></div>
            <?php endif; ?>
            <form style="width: 100%" action="/users/signIn" method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control <?php if ($errors['email']) { echo 'is-invalid'; } ?>"
                           id="email" aria-describedby="emailHelp"
                           placeholder="Enter email" value="<?= $_POST['email'] ?? '' ?>">
                    <?php if ($errors['email']): ?>
                        <div class="invalid-feedback">
                            <?= $errors['email'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" class="form-control <?php if ($errors['pass']) { echo 'is-invalid'; } ?>"
                           id="pass" placeholder="Password">
                    <?php if ($errors['pass']): ?>
                        <div class="invalid-feedback">
                            <?= $errors['pass'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
    </div>

<?php include __DIR__ . '/../parts/footer.php'; ?>