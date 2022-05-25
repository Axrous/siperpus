  <!--side bar-->
  <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark ">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sticky-top">
                    <h1 class="mt-3 border-bottom">SIPERPUS</h1>
                    <ul class="nav nav-pills flex-column mb-auto mt-5">
                        <li class="mb-3"><a href="/" class="text-decoration-none text-white">Dashboard</a></li>
                        <li class="mb-3"><a href="/users/books" class="text-decoration-none text-white">Buku</a></li>
                        <li class="mb-3"><a href="/users/profile" class="text-decoration-none text-white">Profile</a></li>
                    </ul>
                    <div class="fixed-bottom my-4 mx-5">
                        <a href="/users/logout" class="text-decoration-none" style="color:white;"><i class="bi bi-door-closed"></i>Logout</a>
                    </div>
                </div>
            </div>

            <!--Main content-->
            <div class="col py-3">
            <h1>Profile</h1>

<div class="container">
    <div class="row">
        <div class="col-4 ">
            <div class="container">
                <img src="#" class="img-thumbnail" alt="Profile-Picture">
            </div>
        </div>
        <div class="col">
            <form action="#" method="post">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="width: 150px;">Nama</td>
                            <td style="width: 10px;">:</td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><div class="form-check-inline ms-3">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">Male</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">Female</label>
                            </div></td>
                        </tr>
                        <tr>
                            <td>Tempat / Tanggal Lahir</td>
                            <td>:</td>
                            <td><input class="form-control form-control-sm" type="date"></td>
                        </tr>

                        <tr>
                            <td>No. Handphone</td>
                            <td>:</td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="email" class="form-control"></td>
                        </tr>

                    </tbody>
                    </table>
                    <a class="btn btn-primary" href="#" role="button">Save Changes</a>
                    <a class="btn btn-secondary" href="/users/profile">Cancel</a>
            </form>
            
        </div>
    </div>
</div>
            </div>
        </div>
  </div>