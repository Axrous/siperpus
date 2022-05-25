<?php

namespace axrous\siperpus\Service;

use axrous\siperpus\Domain\Peminjaman;
use axrous\siperpus\Model\PinjamBukuRequest;
use axrous\siperpus\Model\PinjamBukuResponse;
use axrous\siperpus\Repository\PinjamRepository;

class PinjamService {
    private PinjamRepository $pinjamRepository;

    public function __construct(PinjamRepository $pinjamRepository)
    {
        $this->pinjamRepository = $pinjamRepository;
    }

    public function pinjamBuku(PinjamBukuRequest $request):PinjamBukuResponse {
        
        $pinjam = new Peminjaman;
        $pinjam->idPinjam = $request->idPeminjaman;
        $pinjam->idUser = $request->iduser;
        $pinjam->kodeBuku = $request->kodeBuku;
        $pinjam->tanggalPinjam = $request->tanggalPinjam;

        $this->pinjamRepository->save($pinjam);

        $response = new PinjamBukuResponse();
        $response->peminjaman = $pinjam;
        return $response;
    }

    public function showBooksUser(string $id) {
        $books = $this->pinjamRepository->findAllByIdUser($id);

        if($books >= 1) {
            return $books;
        } else {
            return null;
        }
    }
    
}