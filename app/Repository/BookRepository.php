<?php

namespace axrous\siperpus\Repository;

use axrous\siperpus\Domain\Book;
use PDO;

class BookRepository {

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Book $book): Book {
        $statement = $this->connection->prepare("INSERT INTO books(id, judul, penulis, penerbit, tahun_terbit, gambar, pdf) VALUES(?,?,?,?,?,?,?)");

        $statement->execute([$book->id, $book->judul, $book->penulis, $book->penerbit, $book->tahunTerbit, $book->gambar, $book->pdf]);

        return $book;
    }

    public function findAll(): ?array {
        $statement = $this->connection->prepare("SELECT id, judul, penulis, penerbit, tahun_terbit, gambar, pdf FROM books");
        $statement->execute();

        if($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
            return $result;
        } else {
            return null;
        }

    }



    public function findById(string $id): ?Book {
        $statement = $this->connection->prepare("SELECT id, judul, penulis, penerbit, tahun_terbit, gambar, pdf FROM books WHERE id = ?");
        $statement->execute([$id]);

       try{
        if($row = $statement->fetch()) {
            $book = new Book();
            $book->id = $row['id'];
            $book->judul = $row['judul'];
            $book->penulis = $row['penulis'];
            $book->penerbit = $row['penerbit'];
            $book->tahunTerbit = $row['tahun_terbit'];
            $book->gambar = $row['gambar'];
            $book->pdf = $row['pdf'];
            return $book;
        } else {
            return null;
        }
       } finally{
           $statement->closeCursor();
       }
    }

    public function update(Book $book): Book {
        $statement = $this->connection->prepare("UPDATE books SET judul = ?, penulis = ?, penerbit = ?, tahun_terbit= ?, gambar = ?, pdf = ?");
        $statement->execute([$book->judul, $book->penulis, $book->penerbit, $book->tahunTerbit, $book->gambar, $book->pdf]);

        return $book;
    }

    public function deleteById(string $id):void {
        $statement = $this->connection->prepare("DELETE from books WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll():void {
        $this->connection->exec("DELETE FROM books");
    }
}