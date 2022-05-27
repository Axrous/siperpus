    <!--side bar-->
    <div class="container-fluid">
        <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark ">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sticky-top">
                    <h1 class="mt-3 border-bottom">SIPERPUS</h1>
                    <ul class="nav nav-pills flex-column mb-auto mt-5">
                      <li class="mb-3"><a href="/" class="text-decoration-none text-white">Dashboard</a></li>
                      <li class="mb-3"><a href="/admin/users" class="text-decoration-none text-white">Anggota</a></li>
                      <li class="mb-3"><a href="/admin/books" class="text-decoration-none text-white">Buku</a></li>
                      <li class="mb-3"><a href="/admin/transaction" class="text-decoration-none text-white">Transaksi</a></li>
                      <li class="mb-3"><a href="#" class="text-decoration-none text-white">Laporan</a></li>
                    </ul>
                    <div class="fixed-bottom my-4 mx-5">
                      <a href="/users/logout" class="text-decoration-none" style="color:white;"><i class="bi bi-door-closed"></i>Logout</a>
                  </div>
                </div>
            </div>

            <!--Main content-->
            <div class="col py-3 px-5">

                <h1>Tambah Buku</h1>

                <div class="mt-5 container ">
                    <form action="/admin/edit-book" method="post" enctype="multipart/form-data">
                        <div class="mb-3 ">
                            <label class="form-label">Kode Buku</label>
                            <input type="text" class="form-control" value="<?=$model['bookCode']?>" name="kode">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" value="<?=$model['judul']?>" name="judul">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Penulis Buku</label>
                            <input type="text" class="form-control" value="<?=$model['penulis']?>" name="penulis">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Penerbit Buku</label>
                            <input type="text" class="form-control" value="<?=$model['penerbit']?>" name="penerbit">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Tahun Terbit Buku</label>
                            <input type="text" class="form-control" value="<?=$model['tahunTerbit']?>" name="tahunTerbit">
                          </div>
                          <div class="mb-3">
                            <label for="formFile" class="form-label">Gambar Buku</label>
                            <input class="form-control" type="file" name="gambar">
                          </div>
                          <div class="mb-3">
                            <label for="formFile" class="form-label">File Buku</label>
                            <input class="form-control" type="file" name="pdf">
                          </div>

                          <div class="col-auto mb-5">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="/admin/books" class="btn btn-secondary">Cancel</a>
                          </div>                 
                    </form>
                </div>

        </div>
    </div>
  </div>