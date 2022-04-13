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

    public function getUniqKode() {
        $statement = $this->connection->prepare("SELECT max(kode_buku) as kodeBuku FROM books");
        $statement->execute();

        if($row = $statement->fetch()) {
            $kodeBuku = $row['kodeBuku'];

            $urutan = (int) substr($kodeBuku, 3, 3);
            $urutan++;
            
            $huruf = "B";
            $kode = $huruf . sprintf("%03s", $urutan);
            return $kode;
        }

    }

    public function save(Book $book): Book {
        $statement = $this->connection->prepare("INSERT INTO books(kode_buku, judul, penulis, penerbit, tahun_terbit, gambar, pdf) VALUES(?,?,?,?,?,?,?)");
        $statement->execute([$book->kode, $book->judul, $book->penulis, $book->penerbit, $book->tahunTerbit, $book->gambar, $book->pdf]);

        return $book;
    }

    public function findByKode(string $kode): ?Book {

        $statement = $this->connection->prepare("SELECT kode_buku, judul, penulis, penerbit, tahun_terbit, gambar, pdf FROM books WHERE kode_buku = ?");
        $statement->execute([$kode]);

        try{
            if($row = $statement->fetch()){
                $book = new Book();
                $book->kode = $row['kode_buku'];
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
        }finally {
            $statement->closeCursor();
        }
    }

    public function findAll(): ?array {
        $statement = $this->connection->prepare("SELECT kode_buku, judul, penulis, penerbit, tahun_terbit, gambar, pdf FROM books");
        $statement->execute();

        if($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
            return $result;
        } else {
            return null;
        }

    }

    public function update(Book $book): Book {
        $statement = $this->connection->prepare("UPDATE books SET judul = ?, penulis = ?, penerbit = ?, tahun_terbit = ?, gambar = ?, pdf = ?");
        $statement->execute([$book->judul, $book->penulis, $book->penerbit, $book->tahunTerbit, $book->gambar, $book->pdf]);

        return $book;
    }

    public function deleteByKode(string $kode):void {
        $statement = $this->connection->prepare("DELETE FROM books WHERE kode_buku = ?");
        $statement->execute([$kode]);
    }



    public function deleteAll():void {
        $this->connection->exec("DELETE FROM books");
    }

    public function sumOfBook() {

        $statement = $this->connection->query("SELECT COUNT(*) as SumBooks FROM books");
        $result = $statement->fetchColumn();

        return $result;
    }
}