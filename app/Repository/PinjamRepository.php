<?php

namespace axrous\siperpus\Repository;

use axrous\siperpus\Domain\Peminjaman;
use PDO;

class PinjamRepository {

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->$connection = $connection;
    }

    public function save(Peminjaman $pinjam): Peminjaman {
        
        $statement = $this->connection->prepare("INSERT INTO peminjaman(id_peminjaman, id_user, kode_buku, tanggal_pinjam) VALUES(?,?,?,?)");
        $statement->execute([$pinjam->idPinjam, $pinjam->idUser, $pinjam->kodeBuku, $pinjam->tanggalPinjam]);

        return $pinjam;
    }

    public function deleteAll() {
        $this->connection->exec("DELETE FROM peminjaman");
    }

    public function findAllByIdUser(string $id):?Peminjaman {

        $statement = $this->connection->prepare("SELECT id_peminjaman, id_user, kode_buku, tanggal_pinjam FROM peminjaman AS p
        JOIN users as u ON p.id_user = u.id
        JOIN books as b ON p.kode_buku = b.kode_buku
        WHERE p.id_user = $id");

    }
    
}