<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\Pagination;
use App\Models\Books\Book;
use App\Exceptions\InvalidArgumentException;

class PaginationTest extends TestCase
{
    protected $data;

    protected $pagination;

    protected function setUp(): void
    {
        $this->data = collect([
            new Book(['isbn' => 1231233211, 'name' => 'Sascventya', 'poster' => '#', 'url' => '#', 'price' => '1.50']),
            new Book(['isbn' => 1468794123, 'name' => 'Xbater', 'poster' => '#', 'url' => '#', 'price' => '2.10']),
            new Book(['isbn' => 7894516479, 'name' => 'Lavantera', 'poster' => '#', 'url' => '#', 'price' => '3.40']),
            new Book(['isbn' => 1231233211, 'name' => 'Ertuva', 'poster' => '#', 'url' => '#', 'price' => '6.50']),
            new Book(['isbn' => 1468794123, 'name' => 'Manteron', 'poster' => '#', 'url' => '#', 'price' => '3.99']),
            new Book(['isbn' => 7894516479, 'name' => 'Quernatn', 'poster' => '#', 'url' => '#', 'price' => '1.99']),

        ]);
        $this->pagination = new Pagination();
    }

    public function testThatWeWillReceiveTwoItems()
    {
        $this->pagination->init($this->data, '', 2)->paginate();
        $this->assertCount(2, $this->pagination->get());
    }

    public function testThatWeWillReceiveException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->pagination->init($this->data, '', 0)->paginate();
    }

    public function testGetPaginationState()
    {
        $this->pagination->init($this->data, '', 6)->paginate();
        $this->assertSame(0, $this->pagination->getPaginationState());
    }

    public function testGetBaseUrl()
    {
        $this->pagination->init($this->data, 'foo', 2)->paginate();
        $this->assertSame('foo', $this->pagination->getBaseUrl());
    }

    public function testGetCurrentPage()
    {
        $this->pagination->init($this->data, '', 2)->paginate();
        $this->assertSame(1, $this->pagination->getCurrentPage());
    }

    protected function tearDown(): void
    {
        unset($this->pagination);
    }
}