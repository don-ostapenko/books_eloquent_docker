<?php include __DIR__ . '/../parts/header.php'; ?>

<?php header('Refresh:2; URL=/' . $url); ?>
<div class="alert <?= $class ?> mt-5" role="alert">
    <?= $message ?> You will be redirected in <span id="counter">2</span> sec.
</div>

<?php include __DIR__ . '/../parts/footer.php'; ?>