<?php include __DIR__ . '/../parts/header.php'; ?>

<div class="row align-items-center title">
    <div class="col">
        <h2 class="pb-3 mt-4"><?= $title ?></h2>
    </div>

    <div class="col-auto">
        <a class="btn btn-light" data-toggle="collapse" href="#search" role="button" aria-expanded="false"
           aria-controls="search"><i class="fas fa-search" style="color: #898990"></i></a>
    </div>
</div>

<div class="card mb-4 collapse multi-collapse" id="search">
    <div class="card-body p-0">
        <form action="/books/search" method="post">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control"
                       style="border: none; height: 50px; padding-left: 20px"
                       placeholder="What are we looking for?"
                       aria-describedby="basic-addon2" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-light">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if ($searchResult[0]): ?>
    <div class="row mb-5">
        <?php foreach ($searchResult as $book): ?>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 p-3 d-flex align-items-stretch">
                <article class="card-wrap">
                    <a href="<?= $book->url ?>" class="book-thumbnail" target="_blank">
                        <img src="<?= $book->poster ?>" alt="poster">
                    </a>
                    <?php if ($book->tags): ?>
                        <?php foreach ($book->tags as $tag): ?>
                            <small class="text-muted"><?= $tag->name ?></small>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <small class="text-muted">-----</small>
                    <?php endif; ?>
                    <a href="<?= $book->url ?>" target="_blank">
                        <h5><?= $book->name ?></h5>
                    </a>
                    <div class="bottom-price">
                        <span class="price"><?= $book->price ?></span>
                    </div>
                    <div class="bottom-small">
                        <small class="text-muted">ISBN: "<?= $book->isbn ?>"</small>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        Sorry, no matches were found for your <b> <?= $titleQuery ?> </b> query
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../parts/footer.php'; ?>