<?php

namespace axrous\siperpus\Service;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Domain\Book;
use axrous\siperpus\Exception\ValidationException;
use axrous\siperpus\Model\BookAddRequest;
use axrous\siperpus\Repository\BookRepository;
use PHPUnit\Framework\TestCase;

class BookServiceTest extends TestCase {

    private BookService $bookService;
    private BookRepository $bookRepository;

    protected function setUp():void
    {
        $connection = Database::getConnection();
        $this->bookRepository = new BookRepository($connection);
        $this->bookService = new BookService($this->bookRepository);

        $this->bookRepository->deleteAll();
    }

    public function testAddBookSuccess(){
        
        $request = new BookAddRequest();
        $request->id = "B0001";
        $request->judul = "Buku Kenangan";
        $request->penulis = "Arga";
        $request->penerbit = "Axrous";
        $request->tahunTerbit = "2021";
        $request->gambar = "gambar.jpg";
        $request->pdf = "buku.pdf";

        $response = $this->bookService->addBook($request);

        $this->assertEquals($request->id, $response->book->id);
        $this->assertEquals($request->judul, $response->book->judul);
        $this->assertEquals($request->penulis, $response->book->penulis);
    }

    public function testAddBookDuplicate() {
        $book = new Book();
        $book->id = "B001";
        $book->judul = "Buku Kenangan";
        $book->penulis = "Arga";
        $book->penerbit = "Axrous";
        $book->tahunTerbit = "2021";
        $book->gambar = "gambar.jpg";
        $book->pdf = "buku.pdf";

        $this->bookRepository->save($book);

        $this->expectException(ValidationException::class);

        $request = new BookAddRequest();
        $request->id = "B001";
        $request->judul = "Buku Kenangan";
        $request->penulis = "Arga";
        $request->penerbit = "Axrous";
        $request->tahunTerbit = "2022";
        $request->gambar ="gambar.jpg";
        $request->pdf = "buku.pdf";
        $this->bookService->addBook($request);
    }

    public function testAddBookFailed() {

        $this->expectException(ValidationException::class);

        $request = new BookAddRequest();
        $request->id = "";
        $request->judul = "";
        $request->penulis = "Arga";
        $request->penerbit = "Axrous";
        $request->tahunTerbit = "2022";
        $request->gambar ="gambar.jpg";
        $request->pdf = "buku.pdf";
        $this->bookService->addBook($request);
    }
    
}