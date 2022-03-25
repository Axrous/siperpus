<?php 

namespace axrous\siperpus\Controller;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Repository\BookRepository;
use axrous\siperpus\Service\BookService;
use axrous\siperpus\App\View;

class BookController{
    private BookService $bookService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $bookRepository = new BookRepository($connection);
        $this->bookService = new BookService($bookRepository);
        
    }

    public function showAllBooks() {
        $books = $this->bookService->showAllBooks();

        View::render('Book/showBooks',[
            "title" => "Data Buku",
            "books" => $books
        ]);
    }

    public function addBook() {
        View::render('Book/addBook',[
            "title" => "Add New Book"
        ]);
    }
}