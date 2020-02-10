<?php

namespace App\Services;

use App\Exceptions\InvalidArgumentException;
use Illuminate\Support\Collection;

class Pagination
{
    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var Collection
     */
    protected $data;

    /**
     * @var int
     */
    protected $totalItemsQty;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $totalPagesQty;

    /**
     * @var int
     */
    protected $currentPage;
    /**
     * @var int
     */
    protected $paginationState = 1;


    /**
     * @return int
     */
    public function getTotalPagesQty(): int
    {
        return ceil($this->totalItemsQty / $this->limit);
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getPaginationState(): int
    {
        return $this->paginationState;
    }

    /**
     * @param int $limit
     * @throws InvalidArgumentException
     */
    private function setLimit(int $limit): void
    {
        if ($limit === 0) {
            throw new InvalidArgumentException('The page limit cannot be less than zero');
        } elseif ($this->totalItemsQty <= $limit) {
            $this->paginationState = 0;
        }

        $this->limit = $limit;
    }


    /**
     * @param $page
     * @return int
     */
    public function initCurrentPage($page): int
    {
        $currentPage = isset($page) ? (int)$page : 1;

        if ($currentPage > $this->totalPagesQty) {
            header('Location: /' . $this->baseUrl . '?page=' . $this->totalPagesQty);
            exit();
        } elseif ($currentPage <= 0) {
            header('Location: /' . $this->baseUrl . '?page=' . $currentPage);
            exit();
        }

        return $currentPage;
    }

    /**
     * @param Collection $data
     * @param string $baseUrl
     * @param integer $limit
     * @param null $currentPage
     * @return self
     * @throws InvalidArgumentException
     */
    public function init(Collection $data, string $baseUrl, int $limit, $currentPage = null): self
    {
        $this->data = $data;
        $this->baseUrl = $baseUrl;
        $this->totalItemsQty = count($data);
        $this->setLimit($limit);
        $this->totalPagesQty = $this->getTotalPagesQty();
        $this->currentPage = $this->initCurrentPage($currentPage);

        return $this;
    }

    /**
     * @return self
     */
    public function paginate(): self
    {
        $offset = ($this->currentPage - 1) * $this->limit;
        $this->data = $this->data->slice($offset, $this->limit);

        return $this;
    }
}