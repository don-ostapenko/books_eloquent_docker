<?php

namespace App\Models\Books;

use App\Models\Tags\Tag;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use App\Exceptions\InvalidArgumentException;

class Book extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['isbn', 'name', 'poster', 'url', 'price'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected static $sortTypeList = [
        [
            'type' => 'price-ASC',
            'name' => 'Price: lowest first'
        ],
        [
            'type' => 'price-DESC',
            'name' => 'Price: highest first'
        ],
        [
            'type' => 'name-ASC',
            'name' => 'Name: A-Z'
        ],
        [
            'type' => 'name-DESC',
            'name' => 'Name: Z-A'
        ]
    ];

    /**
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return array
     */
    public static function getSortTypeList(): array
    {
        return self::$sortTypeList;
    }


    /**
     * @param array $titleQuery
     * @param string $columnName
     * @return array
     */
    public static function searchBy(array $titleQuery, string $columnName): array
    {
        try {
            $searchResult = Book::with('tags')->where($columnName, $titleQuery['search'])
                ->orWhere($columnName, 'like', '%' . $titleQuery['search'] . '%')
                ->get()->toBase();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit();
        }

        return [$titleQuery['search'], $searchResult];
    }

    /**
     * @param string $tagQuery
     * @return mixed
     */
    public static function searchByTag(string $tagQuery): Collection
    {
        return Book::whereHas('tags', function (Builder $query) use ($tagQuery) {
            $query->where('name', $tagQuery);
        })->get();
    }

    /**
     * @param string $sortType
     * @param Collection|null $collection
     * @return Collection
     */
    public static function sortBy(string $sortType, Collection $collection = null): Collection
    {
        list($field, $order) = explode('-', $sortType, 2);

        if ($collection !== null) {
            if ($order === 'ASC') {
                $sorted = $collection->sortBy($field);
            } else {
                $sorted = $collection->sortByDesc($field);
            }
            return $sorted->values()->toBase();
        }

        return Book::orderBy($field, $order)->get();
    }

    /**
     * @param $data
     */
    public static function createBookFromData(array $data): void
    {
        if (empty($data['poster'])) {
            $data['poster'] = 'http://' . $_SERVER['HTTP_HOST'] . '/img/default-cover.jpg';
        }
        if (empty($data['url'])) {
            $data['url'] = '#';
        }

        $book = Book::create($data);
        $book->tags()->attach($data['tags']);
    }

    /**
     * @param array $data
     * @param $book
     */
    public static function updateBookFromData(array $data, Model $book): void
    {
        if (empty($data['poster'])) {
            $data['poster'] = 'http://' . $_SERVER['HTTP_HOST'] . '/img/default-cover.jpg';
        }
        if (empty($data['url'])) {
            $data['url'] = '#';
        }

        $book->update($data);
        $book->tags()->sync($data['tags']);
    }

    /**
     * @param $type
     * @throws InvalidArgumentException
     */
    public static function checkSortType(array $type)
    {
        if (
            $type['sort-type'] !== 'price-ASC' &&
            $type['sort-type'] !== 'price-DESC' &&
            $type['sort-type'] !== 'name-DESC' &&
            $type['sort-type'] !== 'name-ASC'
        ) {
            throw new InvalidArgumentException('Received sort-type is not supported');
        }
    }
}