<?php

return [
    // Books route
    '~^$~' => [App\Controllers\BooksController::class, 'indexBooks'],
    '~^books/filter$~' => [App\Controllers\BooksController::class, 'filterHandler'],
    '~^books/reset$~' => [App\Controllers\BooksController::class, 'filterReset'],
    '~^books/pagination$~' => [App\Controllers\BooksController::class, 'paginationHandler'],
    '~^books/search$~' => [App\Controllers\BooksController::class, 'searchByTitle'],

    // Users route
    '~^users/signIn$~' => [App\Controllers\UsersController::class, 'signIn'],
    '~^users/signOut$~' => [App\Controllers\UsersController::class, 'signOut'],

    // Admin route
    '~^admin$~' => [App\Controllers\AdminController::class, 'indexAdmin'],
    '~^admin/search$~' => [App\Controllers\AdminController::class, 'searchByTitleAdmin'],
    '~^admin/book/add$~' => [App\Controllers\AdminController::class, 'addBook'],
    '~^admin/book/(\d+)/edit$~' => [App\Controllers\AdminController::class, 'editBook'],
    '~^admin/book/(\d+)/delete$~' => [App\Controllers\AdminController::class, 'deleteBook'],
];
