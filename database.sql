CREATE DATABASE siperpus;

CREATE DATABASE siperpus_test;

CREATE TABLE users(
    id VARCHAR(100) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender ENUM('Pria', 'Wanita') NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    role ENUM('1', '2')
) ENGINE =InnoDB;

CREATE TABLE sessions(
    id VARCHAR(255) PRIMARY KEY,
    user_id VARCHAR(100) NOT NULL
) ENGINE = InnoDB;

ALTER TABLE sessions
    ADD CONSTRAINT fk_sessions_users
        FOREIGN KEY (user_id)
            REFERENCES users(id);


CREATE TABLE books(
    kode_buku VARCHAR(8) NOT NULL,
    judul VARCHAR(100) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    tahun_terbit VARCHAR(4) NOT NULL,
    gambar LONGBLOB NOT NULL,
    pdf LONGBLOB NOT NULL,
    PRIMARY KEY(kode_buku)
) ENGINE = InnoDB;


CREATE TABLE peminjaman(
    id_peminjaman VARCHAR(4) NOT NULL,
    id_user VARCHAR(100) NOT NULL,
    kode_buku VARCHAR(100) NOT NULL,
    tanggal_pinjam DATE,
    PRIMARY KEY(id_peminjaman)
) ENGINE = InnoDB;

ALTER TABLE peminjaman
    ADD CONSTRAINT fk_peminjaman_buku
        FOREIGN KEY (kode_buku)
            REFERENCES books(kode_buku);


ALTER TABLE peminjaman
    ADD CONSTRAINT fk_peminjaman_user
        FOREIGN KEY (id_user)
            REFERENCES users(id);