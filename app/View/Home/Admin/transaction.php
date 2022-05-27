<div class="container-fluid">
        <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark ">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sticky-top">
                    <h1 class="mt-3 border-bottom">SIPERPUS</h1>
                    <ul class="nav nav-pills flex-column mb-auto mt-5">
                      <li class="mb-3"><a href="/" class="text-decoration-none text-white">Dashboard</a></li>
                      <li class="mb-3"><a href="/admin/users" class="text-decoration-none text-white">Anggota</a></li>
                      <li class="mb-3"><a href="/admin/books" class="text-decoration-none text-white">Buku</a></li>
                      <li class="mb-3"><a href="" class="text-decoration-none text-white">Transaksi</a></li>
                      <li class="mb-3"><a href="#" class="text-decoration-none text-white">Laporan</a></li>
                    </ul>
                    <div class="fixed-bottom my-4 mx-5">
                      <a href="/users/logout" class="text-decoration-none" style="color:white;"><i class="bi bi-door-closed"></i>Logout</a>
                  </div>
                </div>
            </div>


            <div class="col py-3">

            <h1 class="mb-3">Data Transaksi Peminjaman</h1>
                <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">No. Pinjam</th>
                        <th scope="col">Kode Buku</th>
                        <th scopr col>Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal Pinjam</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        <?php foreach ($model['transaction'] as $user) {?>

                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$user['id_peminjaman']?></td>
                        <td><?=$user['kode_buku']?></td>
                        <td><?=$user['id']?></td>
                        <td><?=$user['name']?></td>
                        <td><?=$user['tanggal_pinjam']?></td>
                      </tr>

                      <?php $no++; } ?>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>