<?php

namespace axrous\siperpus\Service;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Domain\Book;
use axrous\siperpus\Model\BookAddRequest;
use axrous\siperpus\Repository\BookRepository;
use PHPUnit\Framework\TestCase;
use axrous\siperpus\Exception\ValidationException;
use axrous\siperpus\Model\BookUpdateRequest;

class BookServiceTest extends TestCase {

    private BookService $bookService;
    private BookRepository $bookRepository;

    protected function setUp():void
    {
        $this->bookRepository = new BookRepository(Database::getConnection());
        $this->bookService = new BookService($this->bookRepository);

        $this->bookRepository->deleteAll();
    }

    public function testAddBookSuccess() {

        $kode = $this->bookRepository->getUniqKode();

        $request = new BookAddRequest();
        $request->kode = $kode;
        $request->judul = "Buku Kenangan";
        $request->penulis = "Arga Satya";
        $request->penerbit = "Axrous";
        $request->tahunTerbit = "2022";
        $request->gambar = "gambar.jpg";
        $request->pdf = "buku.pdf";

        $response = $this->bookService->addBook($request);

        $this->assertEquals($request->kode, $response->book->kode);
        $this->assertEquals($request->judul, $response->book->judul);
    }

    public function testAddBookFailed() {

        $this->expectException(ValidationException::class);

        $request = new BookAddRequest();
        $request->kode = "";
        $request->judul = "";
        $request->penulis = "Arga";
        $request->penerbit = "Axrous";
        $request->tahunTerbit = "2022";
        $request->gambar ="gambar.jpg";
        $request->pdf = "buku.pdf";
        $this->bookService->addBook($request);
    }

    public function testUpdateSuccess() {

        $book = new Book();
        $book->kode = 'B001';
        $book->judul = 'Buku Kenangan';
        $book->penulis = 'Arga Satya';
        $book->penerbit = 'Axrous';
        $book->tahunTerbit = "2022";
        $book->gambar = "gambar.jpg";
        $book->pdf = "book.pdf";
        $this->bookRepository->save($book);

        $request = new BookUpdateRequest();
        $request->kodeBuku = 'B001';
        $request->judul = "Buku Kenangan";
        $request->penulis = "Arga & Satya";
        $request->penerbit = "Arkuu";
        $request->tahunTerbit = "2022";
        $request->gambar = "gambar1.jpg";
        $request->pdf = "pdf1.pdf";

        $this->bookService->editBook($request);

        $result = $this->bookRepository->findByKode($request->kodeBuku);

        $this->assertEquals($request->penulis, $result->penulis);
        $this->assertEquals($request->penerbit, $result->penerbit);
    }

    public function testUpdateBookFailed() {


        $book = new Book();
        $book->kode = 'B001';
        $book->judul = 'Buku Kenangan';
        $book->penulis = 'Arga Satya';
        $book->penerbit = 'Axrous';
        $book->tahunTerbit = "2022";
        $book->gambar = "gambar.jpg";
        $book->pdf = "book.pdf";
        $this->bookRepository->save($book);

        $this->expectException(ValidationException::class);

        $request = new BookUpdateRequest();
        $request->kodeBuku = 'B001';
        $request->judul = "";
        $request->penulis = "Arga & Satya";
        $request->penerbit = "Arkuu";
        $request->tahunTerbit = "2022";
        $request->gambar = "gambar1.jpg";
        $request->pdf = "pdf1.pdf";

        $this->bookService->editBook($request);
    }
    
}