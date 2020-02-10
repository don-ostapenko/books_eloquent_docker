<?php

namespace App\Controllers;

use App\Exceptions\ForbiddenException;
use App\Exceptions\ServiceNotFoundException;
use App\Models\Books\Book;
use App\Exceptions\UnauthorizedException;
use App\Models\Tags\Tag;
use App\Services\Di\DiContainer;

class AdminController extends AbstractController
{
    /**
     * @var array
     */
    protected $crudRules = [
        'name' => 'required|string',
        'price' => 'required|numeric',
        'poster' => 'skip',
        'url' => 'skip',
        'isbn' => 'required|numeric|length:10',
        'tags' => 'required',
    ];

    /**
     * AdminController constructor.
     * @param DiContainer $di
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws ServiceNotFoundException
     */
    public function __construct($di)
    {
        parent::__construct($di);
        if (!$this->user) {
            throw new UnauthorizedException('You must be logged in');
        }
        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('You have not credentials to access to this page');
        }
    }

    public function indexAdmin()
    {
        $books = Book::all();

        echo $this->view->renderHtml('admin/index', [
            'books' => $books,
            'title' => 'Admin dashboard'
        ]);
    }

    public function searchByTitleAdmin()
    {
        $data = $this->request->request->all();
        $this->validator->validate($data, $this->searchRules);

        if (!$this->validator->getErrors()) {
            list($titleQuery, $searchResult) = Book::searchBy($this->validator->getValidData(), 'name');
            echo $this->view->renderHtml('admin/admin.search', [
                'searchResult' => $searchResult,
                'titleQuery' => $titleQuery,
                'title' => 'Result search for admin'
            ]);
            return;
        }

        echo $this->view->renderHtml('admin/admin.search', [
            'title' => 'Result search for admin',
            'errors' => $this->validator->getErrors(),
        ]);
    }

    public function addBook()
    {
        $tags = Tag::all();

        if ($_POST) {
            $data = $this->request->request->all();
            $this->validator->validate($data, $this->crudRules);

            if (!$this->validator->getErrors()) {
                Book::createBookFromData($this->validator->getValidData());
                echo $this->view->renderHtml('result/page.result', [
                    'class' => 'alert-success',
                    'message' => 'Book was successfully added.',
                    'url' => 'admin',
                ]);
                return;
            } else {
                echo $this->view->renderHtml('admin/admin.book.add', [
                    'title' => 'Add book',
                    'tags' => $tags,
                    'errors' => $this->validator->getErrors(),
                ]);
                return;
            }
        }

        echo $this->view->renderHtml('admin/admin.book.add', [
            'title' => 'Add book',
            'tags' => $tags,
        ]);
    }

    public function editBook($id)
    {
        $book = Book::with('tags')->findOrFail($id);
        $tags = Tag::all();

        if ($_POST) {
            $data = $this->request->request->all();
            $this->validator->validate($data, $this->crudRules);

            if (!$this->validator->getErrors()) {
                Book::updateBookFromData($this->validator->getValidData(), $book);
                echo $this->view->renderHtml('result/page.result', [
                    'class' => 'alert-success',
                    'message' => 'Book was successfully edited.',
                    'url' => 'admin',
                ]);
                return;
            } else {
                echo $this->view->renderHtml('admin/admin.book.edit', [
                    'title' => 'Edit book',
                    'tags' => $tags,
                    'book' => $book,
                    'errors' => $this->validator->getErrors(),
                ]);
                return;
            }
        }

        echo $this->view->renderHtml('admin/admin.book.edit', [
            'title' => 'Edit book: ' . $book->name,
            'tags' => $tags,
            'book' => $book,
        ]);
    }

    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        echo $this->view->renderHtml('result/page.result', [
            'class' => 'alert-success',
            'message' => 'Book was successfully deleted.',
            'url' => 'admin',
        ]);
    }
}