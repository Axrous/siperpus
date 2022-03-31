<?php

require_once __DIR__ . '/../vendor/autoload.php';

use axrous\siperpus\App\Router;
use axrous\siperpus\Config\Database;
use axrous\siperpus\Controller\BookController;
use axrous\siperpus\Controller\HomeController;
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

//Book Controller
Router::add('GET', '/admin/books', BookController::class, 'showAllBooks', [MustAdminMiddleware::class]);
Router::add('GET', '/admin/add-book', BookController::class, 'addBook', [MustAdminMiddleware::class]);
Router::add('POST', '/admin/add-book', BookController::class, 'postAddBook', [MustAdminMiddleware::class]);

Router::run();