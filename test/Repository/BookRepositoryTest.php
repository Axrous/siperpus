<?php

namespace axrous\siperpus\Repository;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Domain\Book;
use PHPUnit\Framework\TestCase;

class BookRepositoryTest extends TestCase {

    private BookRepository $bookRepository;

    protected function setUp():void
    {
        $this->bookRepository = new BookRepository(Database::getConnection());

        $this->bookRepository->deleteAll();
    }

    public function testSaveSuccess() {
        
        $kode = $this->bookRepository->getUniqKode();
        $book = new Book();
        $book->kode = $kode;
        $book->judul = "Buku Kenangan";
        $book->penulis = "Arga";
        $book->penerbit = "Axrous";
        $book->tahunTerbit = "2001";
        $book->gambar = "gambar.jpg";
        $book->pdf = "buku.pdf";

        $this->bookRepository->save($book);
        $result = $this->bookRepository->findByKode($book->kode);
        $this->assertEquals($result->kode, $book->kode);
    }



    public function testFindByKodeNotFound() {
        $result = $this->bookRepository->findByKode("kode");

        $this->assertNull($result);
    }

    public function testFindAll() {
                
        $kode = $this->bookRepository->getUniqKode();

        $book = new Book();
        $book->kode = $kode;
        $book->judul = "Buku Kenangan";
        $book->penulis = "Arga";
        $book->penerbit = "Axrous";
        $book->tahunTerbit = "2001";
        $book->gambar = "gambar.jpg";
        $book->pdf = "buku.pdf";

        $this->bookRepository->save($book);

        $kode = $this->bookRepository->getUniqKode();

        $book1 = new Book();
        $book1->kode = $kode;
        $book1->judul = "Buku Kenangan";
        $book1->penulis = "Arga";
        $book1->penerbit = "Axrous";
        $book1->tahunTerbit = "2001";
        $book1->gambar = "gambar.jpg";
        $book1->pdf = "buku.pdf";
        
        $this->bookRepository->save($book1);

        $result = $this->bookRepository->findAll();
        $this->assertNotEmpty($result);
    }

    public function testUpdate() {
        $kode = $this->bookRepository->getUniqKode();

        $book = new Book();
        $book->kode = $kode;
        $book->judul = "Buku Kenangan";
        $book->penulis = "Arga";
        $book->penerbit = "Axrous";
        $book->tahunTerbit = "2001";
        $book->gambar = "gambar.jpg";
        $book->pdf = "buku.pdf";

        $this->bookRepository->save($book);

        $book->judul = "Buku Sejahtera";
        $book->penulis = "Arga Satya";
        $this->bookRepository->update($book);

        $result = $this->bookRepository->findByKode($book->kode);
        $this->assertEquals($book->judul, $result->judul);
        $this->assertEquals($book->penulis, $result->penulis);
    }

    public function testDeleteByKode() {
        $kode = $this->bookRepository->getUniqKode();

        $book = new Book();
        $book->kode = $kode;
        $book->judul = "Buku Kenangan";
        $book->penulis = "Arga";
        $book->penerbit = "Axrous";
        $book->tahunTerbit = "2001";
        $book->gambar = "gambar.jpg";
        $book->pdf = "buku.pdf";

        $this->bookRepository->save($book);

        $result = $this->bookRepository->findByKode($book->kode);
        $this->assertEquals($book->kode, $result->kode);

        $result = $this->bookRepository->deleteByKode($book->kode);

        $this->assertNull($result);
    }


    
}