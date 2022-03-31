<?php

namespace axrous\siperpus\Service;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Model\BookAddRequest;
use axrous\siperpus\Repository\BookRepository;
use PHPUnit\Framework\TestCase;
use axrous\siperpus\Exception\ValidationException;

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
    
}