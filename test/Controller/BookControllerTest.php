<?php

namespace axrous\siperpus\App{
    function header(string $value) {
        echo $value;
    }
}

namespace axrous\siperpus\Controller{

use axrous\siperpus\Config\Database;
use axrous\siperpus\Exception\ValidationException;
use axrous\siperpus\Repository\BookRepository;
use axrous\siperpus\Service\BookService;
use PHPUnit\Framework\TestCase;
use axrous\siperpus\Domain\Book;

class BookControllerTest extends TestCase {

    private BookRepository $bookRepository;
    private BookService $bookService;
    private BookController $bookController;

    protected function setUp():void
    {
        $connection = Database::getConnection();
        $this->bookRepository = new BookRepository($connection);
        $this->bookService = new BookService($this->bookRepository);
        $this->bookController = new BookController();;
        $this->bookRepository->deleteAll();
    }

    public function testAddBook() {
        $this->bookController->addBook();

        $this->expectOutputRegex('[Tambah Buku]');
        $this->expectOutputRegex('[Kode Buku]');
        $this->expectOutputRegex('[Submit]');
    }

    public function testPostAddBookSuccess() {

        $_POST['judul'] = 'Arga';
        $_POST['penulis'] = 'Arga';
        $_POST['penerbit'] = 'Axrous';
        $_POST['tahunTerbit'] = '2022';
        $_POST['gambar'] = "gambar.jpg";
        $_POST['pdf'] = "buku.pdf";
        
        $this->bookController->postAddBook();
        // $this->expectOutputRegex('[/admin/books]');
        $this->expectOutputRegex('[Arga]');

    }

    public function testPostAddBookFailed() {

        $_POST['judul'] = '';
        $_POST['penulis'] = 'Arga';
        $_POST['penerbit'] = 'Axrous';
        $_POST['tahunTerbit'] = '2022';
        $_POST['gambar'] = "gambar.jpg";
        $_POST['pdf'] = "buku.pdf";
        
        $this->bookController->postAddBook();
        $this->expectOutputRegex('[Add New Book]');
        $this->expectOutputRegex('[Judul Buku]');
        $this->expectOutputRegex('[Submit]');
        

    }

    public function testPostUpdateBookSuccess() {

        $book = new Book();
        $book->kode = 'B001';
        $book->judul = 'Buku Kenangan';
        $book->penulis = 'Arga Satya';
        $book->penerbit = 'Axrous';
        $book->tahunTerbit = "2022";
        $book->gambar = "gambar.jpg";
        $book->pdf = "book.pdf";
        $this->bookRepository->save($book);

        $_POST['kode'] = 'B001';
        $_POST['judul'] = 'Buku Kenangan';
        $_POST['penulis'] = 'Arga';
        $_POST['penerbit'] = 'Arkuu';
        $_POST['tahunTerbit'] = '2024';
        $_POST['gambar'] = "gambar.jpg";
        $_POST['pdf'] = "buku.pdf";

        $this->bookController->postUpdateBook();
        $this->expectOutputRegex("[Location: /admin/books]");
    }
}

}