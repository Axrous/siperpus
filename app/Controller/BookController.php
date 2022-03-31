<?php 

namespace axrous\siperpus\Controller;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Repository\BookRepository;
use axrous\siperpus\Service\BookService;
use axrous\siperpus\App\View;
use axrous\siperpus\Exception\ValidationException;
use axrous\siperpus\Model\BookAddRequest;

class BookController{
    private BookService $bookService;
    private BookRepository $bookRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->bookRepository = new BookRepository($connection);
        $this->bookService = new BookService($this->bookRepository);
        
    }

    public function showAllBooks() {
        $books = $this->bookService->showAllBooks();

        View::render('Book/showBooks',[
            "title" => "Data Buku",
            "books" => $books
        ]);
    }

    public function addBook() {
        $kode = $this->bookRepository->getUniqKode();

        View::render('Book/addBook',[
            "title" => "Add New Book",
            "kode" => $kode
        ]);
    }

    public function postAddBook() {

        $kode = $this->bookRepository->getUniqKode();
        
        $request = new BookAddRequest();
        $request->kode = $_POST['kode'];
        $request->judul = $_POST['judul'];
        $request->penulis = $_POST['penulis'];
        $request->penerbit = $_POST['penerbit'];
        $request->tahunTerbit = $_POST['tahunTerbit'];
        $request->gambar = file_get_contents($_FILES['gambar']['tmp_name']);
        $request->pdf = file_get_contents($_FILES['pdf']['tmp_name']);

        try {
            $this->bookService->addBook($request);
            View::redirect('/admin/books');
        } catch(ValidationException $exception) {
            View::render('Book/addBook',[
                "title" => "Add New Book",
                "kode" => $kode,
                "error" => $exception->getMessage()
            ]);
        }
    }


}