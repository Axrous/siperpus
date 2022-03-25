<?php

namespace axrous\siperpus\Service;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Model\BookAddRequest;
use axrous\siperpus\Model\BookAddResponse;
use axrous\siperpus\Repository\BookRepository;
use axrous\siperpus\Domain\Book;
use axrous\siperpus\Exception\ValidationException;
use Exception;

class BookService {

    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function addBook(BookAddRequest $request): BookAddResponse {


        $this->validateBookAddRequest($request);

        try {
            Database::beginTranscation();

            $book = $this->bookRepository->findById($request->id);
            if($book != null) {
                throw new ValidationException("Buku dengan judul $request->judul sudah ada");
            }

            $book = new Book();
            $book->id = $request->id;
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
        } catch(Exception $exception){
            Database::rollbackTranscation();
            throw $exception;
        }


    }

    public function validateBookAddRequest(BookAddRequest $request) {
        if($request->id == null || $request->judul == null || $request->penulis == null || $request->penerbit == null || $request->tahunTerbit == null || $request->gambar == null || $request->pdf == null || trim($request->id) == "" || trim($request->judul) == "" || trim($request->penulis) == "" || trim($request->penerbit) == '' || trim($request->tahunTerbit) == '') {
            throw new ValidationException("Id, Judul, Penulis, Penerbit, Tahun Terbit, Gambar, PDF cannot Blank");
        }

    }

    public function showAllBooks(): ?array {
        $result = $this->bookRepository->findAll();
        return $result;
    }
}