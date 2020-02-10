<?php include __DIR__ . '/../parts/header.php'; ?>

    <div class="row align-items-center title">
        <div class="col">
            <h2 class="pb-3 mt-4">Our books</h2>
        </div>

        <div class="col-auto">
            <a class="btn btn-light" data-toggle="collapse" href="#search" role="button" aria-expanded="false"
               aria-controls="search"><i class="fas fa-search" style="color: #898990"></i></a>
            <a class="btn btn-light" data-toggle="collapse" href="#filter" role="button" aria-expanded="false"
               aria-controls="filter"><i class="fas fa-filter" style="color: #898990"></i></a>
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

    <div class="row mb-3 collapse multi-collapse" id="filter">

        <div class="col show filter">
            <form class="form-inline" action="/books/filter" enctype="multipart/form-data" method="post">
                <!--<label class="my-1 mr-2" for="filter-items">Filter by tag:</label>-->
                <select class="custom-select my-1 mr-sm-2" id="filter-tag" name="filter-tag">
                    <option value="" selected disabled hidden>Filter by</option>
                    <?php if ($tags): ?>
                        <?php foreach ($tags as $tag): ?>
                            <option value="<?= $tag->name ?>"><?= $tag->name ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <!--<label class="my-1 mr-2" for="sort-items">Sort by:</label>-->
                <select class="custom-select my-1 mr-sm-2" id="sort-type" name="sort-type">
                    <option value="" selected disabled hidden>Sort by</option>
                    <?php if ($sortTypeList): ?>
                        <?php foreach ($sortTypeList as $type): ?>
                            <option value="<?= $type['type'] ?>"><?= $type['name'] ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <button type="submit" class="btn btn-primary my-1 mr-2">Apply</button>
                <?php if ($filterTag !== null || $sortType !== null): ?>
                    <a class="btn btn-light" href="/books/reset" role="button">Reset</a>
                <?php else: ?>
                    <a class="btn btn-light disabled" href="/books/reset" role="button">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="col-auto show-items">
            <form class="form-inline" action="/books/pagination" enctype="multipart/form-data" method="post">
                <small id="page-limit" class="form-text text-muted mr-2">Now: <?= $_COOKIE['page_limit'] ?? 4 ?></small>
                <input type="text" class="form-control" name="page-limit"
                       style="width: 90px; margin-right: 10px"
                       id="page-limit" placeholder="Show by:" required>
                <button type="submit" class="btn btn-primary my-1">Show</button>
            </form>
        </div>
    </div>


<?php if ($books): ?>
    <div class="row mb-5">
        <?php foreach ($books as $book): ?>
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
                        <span class="price">$ <?= $book->price ?></span>
                    </div>
                    <div class="bottom-small">
                        <small class="text-muted">ISBN: "<?= $book->isbn ?>"</small>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>We have not books!</p>
<?php endif; ?>

<?php if ($pagination->getPaginationState()): ?>
    <?= $paginationHtml ?>
<?php endif; ?>

<?php include __DIR__ . '/../parts/footer.php'; ?>