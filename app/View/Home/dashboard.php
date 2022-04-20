  <!--side bar-->
  <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark ">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sticky-top">
                    <h1 class="mt-3 border-bottom">SIPERPUS</h1>
                    <ul class="nav nav-pills flex-column mb-auto mt-5">
                        <li class="mb-3"><a href="/" class="text-decoration-none text-white">Dashboard</a></li>
                        <li class="mb-3"><a href="/user/books" class="text-decoration-none text-white">Buku</a></li>
                        <li class="mb-3"><a href="/user/profile" class="text-decoration-none text-white">Profile</a></li>
                    </ul>
                    <div class="fixed-bottom my-4 mx-5">
                        <a href="users/logout" class="text-decoration-none" style="color:white;"><i class="bi bi-door-closed"></i>Logout</a>
                    </div>
                </div>
            </div>

            <!--Main content-->
            <div class="col py-3">
                <h3 class="mb-5">Selamat Datang <?= $model['user']['name']?></h3>
                <div class="container mx-auto">
                    <div class="row" style="grid-template-columns: repeat(auto-fill, 100px); justify-content: space-between; grid-gap: 20px;">
                    <?php foreach($model['books'] as $book) { ?>
                        <div class="card mx-1 my-2" style="width: 15rem;">
                            <div class="ratio ratio-1x1">
                              <img alt="Card image cap" class="card-img-top embed-responsive-item" src="/image-book/<?= $book['kode_buku']?>" style="object-fit: cover;"/>
                            </div>
                            <div class="card-body">
                              <h5 class="card-title"><?= $book['judul']?></h5>
                              <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                              <a href="#" class="btn btn-primary">Pinjam</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    </div>
            </div>
        </div>