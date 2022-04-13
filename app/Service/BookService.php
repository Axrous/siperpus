<?php

namespace axrous\siperpus\Service;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Domain\Book;
use axrous\siperpus\Exception\ValidationException;
use axrous\siperpus\Model\BookAddRequest;
use axrous\siperpus\Model\BookAddResponse;
use axrous\siperpus\Repository\BookRepository;
use Exception;

class BookService {

    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function addBook(BookAddRequest $request) :BookAddResponse {

        $this->ValidateBookAddRequest($request);

        try{
        Database::beginTranscation();

        $book = new Book();
        $book->kode = $request->kode;
        $book->judul = $request->judul;
        $book->penulis = $request->penulis;
        $book->penerbit = $request->penerbit;
        $book->tahunTerbit = $request->tahunTerbit;
        $book->gambar = $request->gambar;
        $book->pdf = $request->pdf;

        $this->bookRepository->save($book);

        $response = new BookAddResponse();
        $response->book = $book;
        Database::commitTranscation();
        return $response;
        } catch(Exception $exception) {
            Database::rollbackTranscation();
            throw $exception;
        }

    }

    public function ValidateBookAddRequest(BookAddRequest $request) {
        if($request->judul == null || $request->penulis == null || $request->penerbit == null || $request->tahunTerbit == null || $request->gambar == null || $request->pdf == null || trim($request->judul) == "" || trim($request->penulis) == "" || trim($request->penerbit) == "" || trim($request->tahunTerbit) == "" || trim($request->gambar) == "" || trim($request->pdf) == "") {
            throw new ValidationException("Judul, Penulis, Penerbit, Tahun Terbit, Gambar, PDF tidak boleh kosong");
        }
    }

    public function showAllBooks() {
        $result = $this->bookRepository->findAll();
        return $result;
    }

    public function showImage(string $kode) {
        $image = $this->bookRepository->findByKode($kode);
        return $image->gambar;
    }

    public function detailBook(string $kode) {
        $book = $this->bookRepository->findByKode($kode);
        return $book;
    }

    public function showSumUsers() {
        $sumUsers = $this->bookRepository->sumOfBook();

        return $sumUsers;
    }
}