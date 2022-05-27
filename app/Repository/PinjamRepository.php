<?php

namespace axrous\siperpus\Repository;

use axrous\siperpus\Domain\Peminjaman;
use PDO;

class PinjamRepository {

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getUniqKode() {
        $statement = $this->connection->prepare("SELECT max(id_peminjaman) as idPinjam FROM peminjaman");
        $statement->execute();

        if($row = $statement->fetch()) {
            $idPinjam = $row['idPinjam'];

            $urutan = (int) substr($idPinjam, 3, 3);
            $urutan++;
            
            $huruf = "B";
            $kode = $huruf . sprintf("%03s", $urutan);
            return $kode;
        }

    }

    public function save(Peminjaman $pinjam): Peminjaman {
        
        $statement = $this->connection->prepare("INSERT INTO peminjaman(id_peminjaman, id_user, kode_buku, tanggal_pinjam) VALUES(?,?,?,?)");
        $statement->execute([$pinjam->idPinjam, $pinjam->idUser, $pinjam->kodeBuku, $pinjam->tanggalPinjam]);

        return $pinjam;
    }

    public function deleteAll() {
        $this->connection->exec("DELETE FROM peminjaman");
    }

    public function findAllByIdUser(string $id):?Array {

        $statement = $this->connection->prepare("SELECT books.kode_buku, books.gambar, books.judul, books.penulis, books.penerbit, books.tahun_terbit, peminjaman.tanggal_pinjam FROM books
        JOIN peminjaman on books.kode_buku = peminjaman.kode_buku
        JOIN users on users.id = peminjaman.id_user
        WHERE users.id = ?");
        $statement->execute([$id]);

        if($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
            return $result;
        } else {
            return null;
        }
        
    }

    public function findAll() {
        $statement = $this->connection->prepare("SELECT peminjaman.id_peminjaman, users.id, users.name, peminjaman.tanggal_pinjam, books.kode_buku FROM books
        JOIN peminjaman on books.kode_buku = peminjaman.kode_buku
        JOIN users on users.id = peminjaman.id_user");
        $statement->execute();

        if($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }
    
}