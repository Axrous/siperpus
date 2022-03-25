<div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark ">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sticky-top">
                    <h1 class="mt-3 border-bottom">SIPERPUS</h1>
                    <ul class="nav nav-pills flex-column mb-auto mt-5">
                      <li class="mb-3"><a href="/" class="text-decoration-none text-white">Dashboard</a></li>
                      <li class="mb-3"><a href="user.html" class="text-decoration-none text-white">Anggota</a></li>
                      <li class="mb-3"><a href="/admin/books" class="text-decoration-none text-white">Buku</a></li>
                      <li class="mb-3"><a href="transaction.html" class="text-decoration-none text-white">Transaksi</a></li>
                      <li class="mb-3"><a href="#" class="text-decoration-none text-white">Laporan</a></li>
                    </ul>
                    <div class="fixed-bottom my-4 mx-5">
                      <a href="/users/logout" class="text-decoration-none" style="color:white;"><i class="bi bi-door-closed"></i>Logout</a>
                  </div>
                </div>
            </div>

            <!--Main content-->
            <div class="col py-3">

                <h1 class="mb-3">Data Buku</h1>

                <div class="tambah-buku">
                    <a href="/admin/add-book" class="btn btn-primary btn-lg mb-5" role="button" aria-disabled="true">Tambah Buku</a>
                </div>
                <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col" style="width: 150px;">Gambar Buku</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">File Buku</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model['books'] as $book) { ?>
                      <tr>
                        <th scope="row">1</th>
                        <td><img src="<?= $book['gambar']?>" class="img-thumbnail img-fluid" alt=""></td>
                        <td><?= $book['id']?></td>
                        <td><?= $book['judul']?></td>
                        <td><?= $book['penulis']?></td>
                        <td><?= $book['penerbit']?></td>
                        <td><?= $book['tahun_terbit']?></td>
                        <td><?= $book['pdf']?></td>
                        <td><a href="book-edit.html">Edit</a> || <a href="#">Hapus</a></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
        </div>
    </div>