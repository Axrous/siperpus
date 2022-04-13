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
                <h1>Data Anggota</h1>

                <table class="table mt-5 mx-auto">
                    <caption>List of users</caption>
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Email</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $angka = 1;?>
                        <?php foreach($model['user'] as $user) { ?>
                      <tr>
                        <th scope="row"><?=$angka?></th>
                        <td><?=$user['id']?></td>
                        <td><?=$user['name']?></td>
                        <td><?=$user['gender']?></td>
                        <td><?=$user['email']?></td>
                      </tr>
                      <?php $angka++; }?>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>