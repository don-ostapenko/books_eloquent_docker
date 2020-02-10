<?php

namespace App\Controllers;

use App\Exceptions\InvalidArgumentException;
use App\Models\Books\Book;
use App\Models\Tags\Tag;
use App\Support\Cookie;

class BooksController extends AbstractController
{
    public function indexBooks()
    {
        $books = Book::with('tags')->get()->toBase();
        $tags = Tag::all();
        $sortTypeList = Book::getSortTypeList();

        if (Cookie::has('filter_tag')) {
            $filterTag = Cookie::get('filter_tag');
            $books = Book::searchByTag($filterTag);
        }

        if (Cookie::has('sort_type')) {
            $sortType = Cookie::get('sort_type');
            $books = Book::sortBy($sortType, $books);
        }

        try {
            $pageLimit = Cookie::get('page_limit') ?? 4;
            $currentPage = $this->request->query->get('page');
            $pagination = $this->pagination->init($books, '', $pageLimit, $currentPage);
            $books = $this->pagination->paginate()->get();
            $paginationHtml = $this->renderPagination($this->pagination);
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }

        echo $this->view->renderHtml('books/books', [
            'title' => 'Our books',
            'books' => $books,
            'tags' => $tags,
            'filterTag' => $filterTag ?? null,
            'sortType' => $sortType ?? null,
            'sortTypeList' => $sortTypeList,
            'pagination' => $pagination,
            'paginationHtml' => $paginationHtml,
        ]);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function filterHandler()
    {
        if ($_POST['filter-tag']) {
            Cookie::set('filter_tag', $_POST['filter-tag']);
        }

        if ($_POST['sort-type']) {
            Book::checkSortType($_POST);
            Cookie::set('sort_type', $_POST['sort-type']);
        }

        header('Location: /');
    }

    public function paginationHandler()
    {
        if ($_POST['page-limit']) {
            Cookie::set('page_limit', $_POST['page-limit']);
        }

        header('Location: /');
    }

    public function searchByTitle()
    {
        $query = $this->request->request->all();
        if ($query) {
            $this->validator->validate($query, $this->searchRules);
            if (!$this->validator->getErrors()) {
                list($titleQuery, $searchResult) = Book::searchBy($this->validator->getValidData(), 'name');
                echo $this->view->renderHtml('search/search', [
                    'searchResult' => $searchResult,
                    'titleQuery' => $titleQuery,
                    'title' => 'Result search'
                ]);
                return;
            }
            echo $this->view->renderHtml('search/search', [
                'title' => 'Result search',
                'errors' => $this->validator->getErrors(),
            ]);
        }
    }

    public function filterReset()
    {
        Cookie::unset('filter_tag');
        Cookie::unset('sort_type');
        header('Location: /');
    }
}