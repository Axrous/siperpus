<section style="height:100vh; background-color:#f3f4fb;">
<?php if(isset($model['error'])) { ?>
        <div class="row">
            <div class="alert alert-danger" role="alert">
                <?= $model['error'] ?>
            </div>
        </div>
    <?php } ?>
    
        <div class="h-100 d-flex flex-column justify-content-center align-items-center">
            <div class="border rounded-3 shadow-sm p-3 mb-5 bg-body px-4" style="background-color: #fff; width: 400px;">
                <h4 class="text-center mt-4" style="font-family: Spectral;">Create Account</h4>
                <form action="" method="post">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label fs-6">ID</label>
                      <input type="text" class="form-control form-control-sm" name="id" value="<?=$_POST["id"] ?? ""?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label fs-6">Name</label>
                        <input type="text" class="form-control form-control-sm" name="name" value="<?=$_POST["name"] ?? ""?>">
                      </div>
                    <div class="gender mb-1">
                        <label for="" class="form-label">Gender:</label>
                        <div class="form-check-inline ms-3">
                            <input class="form-check-input" type="radio" name="gender" value="Pria" checked>
                            <label class="form-check-label" for="flexRadioDefault1" >Male</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Wanita">
                            <label class="form-check-label" for="flexRadioDefault2">Female</label>
                        </div>
                    </div>

                    <div class="birth mb-3">
                        <label for="" class="form-label">Email</label>
                        <input class="form-control form-control-sm" type="email" name="email" value="<?=$_POST["email"] ?? ""?>">
                    </div>


                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control form-control-sm" name="password">
                    </div>
                    <div class="d-grid mt-4 mb-3">
                        <button class="btn" type="submit" style="background-color:#2a7cf3; color: #fff; font: 14px 'Roboto Mono';">Sign Up</button>
                      </div>
                  </form>
                  <div>
                <p style="font: 14px 'Roboto Mono';">Already have an account? <a href="/users/login" class="link-dark text-decoration-none"><b>Login!</b></a></p>
            </div>
            </div>
    </section>