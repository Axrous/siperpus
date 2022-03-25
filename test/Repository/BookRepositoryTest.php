<?php

namespace axrous\siperpus\Repository;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Domain\Book;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertIsArray;

class BookRepositoryTest extends TestCase {

    private BookRepository $bookRepository;

    protected function setUp():void
    {
        $this->bookRepository = new BookRepository(Database::getConnection());
        $this->bookRepository->deleteAll();
    }

    public function testSaveSuccess() {
        $book = new Book();
        $book->id = "B0001";
        $book->judul = "Buku Kenangan";
        $book->penulis = "Arga Satya";
        $book->penerbit = "Arga";
        $book->tahunTerbit = "2022";
        $book->gambar = "image.jpg";
        $book->pdf = "buku.pdf";

        $this->bookRepository->save($book);

        $result = $this->bookRepository->findById($book->id);

        $this->assertEquals($result->id, $book->id);

    }

    public function testFindByIdNotFound() {

        $result = $this->bookRepository->findById("coba");

        $this->assertNull($result);
    }
    
    public function testFindAll() {
        $book = new Book();
        $book->id = "B0001";
        $book->judul = "Buku Kenangan";
        $book->penulis = "Arga Satya";
        $book->penerbit = "Arga";
        $book->tahunTerbit = "2022";
        $book->gambar = "image.jpg";
        $book->pdf = "buku.pdf";

        $this->bookRepository->save($book);

        $book = new Book();
        $book->id = "B0002";
        $book->judul = "Buku Ketenangan";
        $book->penulis = "Arga Satya";
        $book->penerbit = "Arga";
        $book->tahunTerbit = "2022";
        $book->gambar = "image.jpg";
        $book->pdf = "buku.pdf";

        $this->bookRepository->save($book);

        $result = $this->bookRepository->findAll();
        
        $this->assertNotEmpty($result);
    }

    public function testUpdate() {
        $book = new Book();
        $book->id = "B0001";
        $book->judul = "Buku Kenangan";
        $book->penulis = "Arga Satya";
        $book->penerbit = "Arga";
        $book->tahunTerbit = "2022";
        $book->gambar = "image.jpg";
        $book->pdf = "buku.pdf";

        $this->bookRepository->save($book);

        $book->judul = "Buku Sejarah";
        $this->bookRepository->update($book);

        $result = $this->bookRepository->findById($book->id);

        $this->assertEquals($book->judul, $result->judul);

    }

    public function testDeleteByIdSuccess() {
        $book = new Book();
        $book->id = "B0001";
        $book->judul = "Buku Kenangan";
        $book->penulis = "Arga Satya";
        $book->penerbit = "Arga";
        $book->tahunTerbit = "2022";
        $book->gambar = "image.jpg";
        $book->pdf = "buku.pdf";

        $this->bookRepository->save($book);
        $result = $this->bookRepository->findById($book->id);
        $this->assertEquals($book->id, $result->id);

        $result = $this->bookRepository->deleteById($book->id);

        $this->assertNull($result);
    }


}
