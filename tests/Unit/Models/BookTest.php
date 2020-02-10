<?php

namespace Tests\Unit\Models;

use App\Exceptions\InvalidArgumentException;
use App\Services\Migration;
use PHPUnit\Framework\TestCase;
use App\Models\Books\Book;

class BookTest extends TestCase
{
    protected function setUp(): void
    {
        Migration::connectToDb();
    }

    public function testGetSortTypeList()
    {
        $expected = [
            ['type' => 'price-ASC', 'name' => 'Price: lowest first'],
            ['type' => 'price-DESC', 'name' => 'Price: highest first'],
            ['type' => 'name-ASC', 'name' => 'Name: A-Z'],
            ['type' => 'name-DESC', 'name' => 'Name: Z-A']
        ];

        $this->assertSame($expected, Book::getSortTypeList());
    }

    public function testThatSearchReturnBookByName()
    {
        $query = ['search' => 'lara'];
        list($query, $result) = Book::searchBy($query, 'name');
        $this->assertCount(1, $result);
    }

    public function testThatSearchByTagReturnBookByTag()
    {
        $result = Book::searchByTag('laravel');
        $this->assertInstanceOf(Book::class, $result[0]);
    }

    public function testSortByDesc()
    {
        $collection = collect([['price' => 1], ['price' => 2], ['price' => 3], ['price' => 4], ['price' => 5]]);
        $result = Book::sortBy('price-DESC', $collection);
        $this->assertSame(5, $result[0]['price']);
    }

    public function testSortByAsc()
    {
        $collection = collect([['price' => 4], ['price' => 2], ['price' => 1], ['price' => 3], ['price' => 5]]);
        $result = Book::sortBy('price-ASC', $collection);
        $this->assertSame(1, $result[0]['price']);
    }

    public function testCheckSortType()
    {
        $this->expectException(InvalidArgumentException::class);
        Book::checkSortType(['sort-type' => 'foo']);
    }
}