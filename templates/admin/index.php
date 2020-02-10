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
        <form action="/admin/search" method="post">
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

<div class="row">
    <div class="col-12">
        <?php if ($books): ?>
            <div class="accordion mb-5" id="accordionBooks">
                <?php foreach ($books as $book): ?>
                    <div class="card">
                        <div class="card-header" style="background-color: rgba(0,0,0,0.02)" id="heading<?= $book->id ?>">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapse<?= $book->id ?>"
                                        aria-expanded="false" aria-controls="collapse<?= $book->id ?>">
                                    <?= $book->name ?>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse<?= $book->id ?>" class="collapse multi-collapse"
                             aria-labelledby="heading<?= $book->id ?>"
                             data-parent="#accordionBooks">
                            <div class="card-body" style="padding: 2.25rem">
                                <div class="row align-items-center title">
                                    <div class="col-auto">
                                        <a href="<?= $book->poster ?>" target="_blank">
                                            <img src="<?= $book->poster ?>" width="75px" alt="poster">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <ul class="list-group list-group-horizontal">
                                            <li class="list-group-item">
                                                <p class="price m-0" style="font-size: 16px">
                                                    Price: <?= $book->price ?>
                                                </p>
                                            </li>
                                            <li class="list-group-item">
                                                <p class="isbn m-0" style="font-size: 16px">
                                                    ISBN: <?= $book->isbn ?>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-light" href="<?= $book->url ?>" role="button" target="_blank">
                                            <i class="fas fa-globe" style="color: #898990"></i>
                                        </a>
                                        <a class="btn btn-light" href="/admin/book/<?= $book->id ?>/edit" role="button">
                                            <i class="fas fa-pencil-alt" style="color: #898990"></i>
                                        </a>
                                        <a class="btn btn-light" href="/admin/book/<?= $book->id ?>/delete" role="button">
                                            <i class="fas fa-trash-alt" style="color: #898990"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>We have not books!</p>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../parts/footer.php'; ?>