<?php 

namespace axrous\siperpus\Controller;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Repository\BookRepository;
use axrous\siperpus\Service\BookService;
use axrous\siperpus\App\View;
use axrous\siperpus\Domain\Book;
use axrous\siperpus\Exception\ValidationException;
use axrous\siperpus\Model\BookAddRequest;
use axrous\siperpus\Model\BookUpdateRequest;

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
        $request->kode = $kode;
        $request->judul = $_POST['judul'];
        $request->penulis = $_POST['penulis'];
        $request->penerbit = $_POST['penerbit'];
        $request->tahunTerbit = $_POST['tahunTerbit'];
        $request->gambar = file_get_contents($_FILES['gambar']['tmp_name']);
        $request->pdf = file_get_contents($_FILES['pdf']['tmp_name']);
        // $request->gambar = $_POST['gambar'];
        // $request->pdf = $_POST['pdf'];

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

    public function showImage(string $kode) {
        $image = $this->bookService->showImage($kode);
        header("Content-type: image/jpeg");
        echo $image;
    }

    public function detailBook(string $kode) {
        $book = $this->bookService->detailBook($kode);
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename=document.pdf');
        // // header('Content-Transfer-Encoding: binary');
        // // header('Accept-Ranges: bytes');
        // echo $book;
        // readfile($book);
        View::render('/Book/detail-book', [
            "title" => "SIPERPUS",
            "pdf" => $book->pdf
        ]);
    }

    public function updateBook(string $kode) {

        $book = $this->bookService->detailBook($kode);

        View::render('Book/editBook', [
            "title" => "Edit Buku",
            "bookCode" => $book->kode,
            "judul" => $book->judul,
            "penulis" => $book->penulis,
            "penerbit" => $book->penerbit,
            "tahunTerbit" => $book->tahunTerbit,
        ]);
    }

    public function postUpdateBook() {

        $request = new BookUpdateRequest();
        $request->kodeBuku = $_POST['kode'];
        $request->judul = $_POST['judul'];
        $request->penulis = $_POST['penulis'];
        $request->penerbit = $_POST['penerbit'];
        $request->tahunTerbit = $_POST['tahunTerbit'];
        $request->gambar = file_get_contents($_FILES['gambar']['tmp_name']);
        $request->pdf = file_get_contents($_FILES['pdf']['tmp_name']);
        // $request->gambar = $_POST['gambar'];
        // $request->pdf = $_POST['pdf'];

        try {
            $this->bookService->editBook($request);
            View::redirect('/admin/books');

            // var_dump($_POST['kode']);
        } catch (ValidationException $exception){
            View::render('Book/editBook', [
                "title" => "Edit Buku",
                "error" => $exception->getMessage(),
            ]);
        }

    }

    public function deleteBook(string $kode) {
        $this->bookService->deleteBook($kode);

        View::redirect('/admin/books');
    }
}