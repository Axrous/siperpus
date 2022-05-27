<?php

require_once __DIR__ . '/../vendor/autoload.php';

use axrous\siperpus\App\Router;
use axrous\siperpus\Config\Database;
use axrous\siperpus\Controller\BookController;
use axrous\siperpus\Controller\HomeController;
use axrous\siperpus\Controller\PinjamController;
use axrous\siperpus\Controller\UserController;
use axrous\siperpus\Middleware\MustAdminMiddleware;
use axrous\siperpus\Middleware\MustLoginMiddleware;
use axrous\siperpus\Middleware\MustNotLoginMiddleware;

Database::getConnection("prod");



//Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);

//User Controller
Router::add('GET', '/users/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
Router::add('GET', '/users/login', UserController::class, "login", [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/users/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/users',UserController::class, 'users', [MustAdminMiddleware::class]);
Router::add('GET', '/users/books', PinjamController::class, 'booksUser', [MustLoginMiddleware::class]);
Router::add('GET', '/users/profile', UserController::class, "userProfile", [MustLoginMiddleware::class]);
Router::add('GET', '/users/profile/edit', UserController::class, "profileEdit", [MustLoginMiddleware::class]);
Router::add('POST', '/users/profile/edit', UserController::class, 'postProfileEdit', [MustLoginMiddleware::class]);

//Book Controller
Router::add('GET', '/admin/books', BookController::class, 'showAllBooks', [MustAdminMiddleware::class]);
Router::add('GET', '/admin/add-book', BookController::class, 'addBook', [MustAdminMiddleware::class]);
Router::add('POST', '/admin/add-book', BookController::class, 'postAddBook', [MustAdminMiddleware::class]);
Router::add('GET', '/image-book/([0-9A-Z]*)', BookController::class, 'showImage', []);
Router::add('GET', '/book/([0-9a-zA-Z]*)', BookController::class, 'detailBook', []);
Router::add('GET', '/admin/edit-book/([0-9a-zA-Z]*)', BookController::class, 'updateBook', [MustAdminMiddleware::class]);
Router::add('POST', '/admin/edit-book', BookController::class, 'postUpdateBook', [MustAdminMiddleware::class]);
Router::add('GET', '/admin/delete-book/([0-9a-zA-Z]*)', BookController::class, 'deleteBook', [MustAdminMiddleware::class]);
Router::add('GET', '/users/book/([0-9a-zA-Z]*)', BookController::class, 'showBookPage', []);

//Pinjam Controll
Router::add('POST', '/users/pinjam/([0-9a-zA-Z]*)', PinjamController::class, 'postAddPeminjaman', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/transaction', PinjamController::class, 'showTransaction', [MustAdminMiddleware::class]);
Router::run();