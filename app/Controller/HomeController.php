<?php

namespace axrous\siperpus\Controller;

use axrous\siperpus\App\View;
use axrous\siperpus\Config\Database;
use axrous\siperpus\Repository\BookRepository;
use axrous\siperpus\Repository\SessionRepository;
use axrous\siperpus\Repository\UserRepository;
use axrous\siperpus\Service\BookService;
use axrous\siperpus\Service\SessionService;
use axrous\siperpus\Service\UserService;

class HomeController {

    private SessionService $sessionService;
    private UserService $userService;
    private BookService $bookService;

    public function __construct()
    {
        $connection = Database::getConnection();

        $bookRepository = new BookRepository($connection);
        $this->bookService = new BookService($bookRepository);

        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    
    public function index(){

        $user = $this->sessionService->current();
        $sumBook = $this->bookService->showSumUsers();
        $sumUsers = $this->userService->showSumUsers();
        $allBook = $this->bookService->showAllBooks();

        if($user == null) {
            View::render('Home/index', [
                "title" => "SIPERPUS"
            ]);
        } else {
            if($user->role == "1") {
                View::render('Home/dashboard', [
                    "title" => "Dashboard",
                    "user" => [
                        "name" => $user->name,
                    ],
                    "books" => $allBook
                ]);
            }
            if($user->role == "2") {
                View::render('Home/Admin/dashboard', [
                    "title" => "SIPERPUS",
                    "sumBooks" => $sumBook,
                    "sumUsers" => $sumUsers
                ]);
            }
           
            }
        }

    
}