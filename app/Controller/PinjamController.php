<?php

namespace axrous\siperpus\Controller;

use axrous\siperpus\App\View;
use axrous\siperpus\Config\Database;
use axrous\siperpus\Exception\ValidationException;
use axrous\siperpus\Model\PinjamBukuRequest;
use axrous\siperpus\Repository\PinjamRepository;
use axrous\siperpus\Repository\SessionRepository;
use axrous\siperpus\Repository\UserRepository;
use axrous\siperpus\Service\PinjamService;
use axrous\siperpus\Service\SessionService;

class PinjamController {
    

    private PinjamService $pinjamService;
    private SessionService $sessionService;
    private PinjamRepository $pinjamRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->pinjamRepository = new PinjamRepository($connection);
        $this->pinjamService = new PinjamService($this->pinjamRepository);

        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function postAddPeminjaman(string $kodeBuku) {
        
        $user = $this->sessionService->current();
        $kode = $this->pinjamRepository->getUniqKode();

        $request = new PinjamBukuRequest();
        $request->idPeminjaman = $kode;
        $request->iduser = $user->id;
        $request->kodeBuku = $kodeBuku;
        $request->tanggalPinjam = date("Y-m-d");
        
        try {
            $this->pinjamService->pinjamBuku($request);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::redirect('/404');
        }
    }

    public function booksUser() {

        $user = $this->sessionService->current();
        $books = $this->pinjamService->showBooksUser($user->id);
        View::render("User/book-page",[
            "title" => "Buku Pinjaman",
            "books" => $books
        ]);
    }
}