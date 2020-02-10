<div class="row mt-4 mb-5 justify-content-center">
    <div class="col-auto">
        <nav aria-label="Page navigation example">
            <ul class="pagination">


                <?php if ($paginatorInstance->getCurrentPage() == 1): ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">&laquo;</a>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="/<?= $paginatorInstance->getBaseUrl() ?>?page=<?= ($paginatorInstance->getCurrentPage() - 1) ?>"
                           aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                <?php endif; ?>


                <?php for ($i = 1; $i <= $paginatorInstance->getTotalPagesQty(); $i++): ?>
                    <?php if ($i == $paginatorInstance->getCurrentPage()): ?>
                        <li class="page-item active">
                            <a class="page-link"><?= $i ?><span class="sr-only">(current)</span></a>
                        </li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link" href="/<?= $paginatorInstance->getBaseUrl() ?>?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>


                <?php if ($paginatorInstance->getCurrentPage() == $paginatorInstance->getTotalPagesQty()): ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">&raquo;</a>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="/<?= $paginatorInstance->getBaseUrl() ?>?page=<?= ($paginatorInstance->getCurrentPage() + 1) ?>"
                           aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>
</div>
