<?php

namespace axrous\siperpus\Model;

class BookAddRequest {
    public ?string $kode = null;
    public ?string $judul = null;
    public ?string $penulis = null;
    public ?string $penerbit = null;
    public ?string $tahunTerbit = null;
    public $gambar = null;
    public $pdf = null;
}