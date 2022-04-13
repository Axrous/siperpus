<section style="height:100vh; background-color:#f3f4fb;">
<?php if(isset($model['error'])) { ?>
        <div class="row">
            <div class="alert alert-danger" role="alert">
                <?= $model['error'] ?>
            </div>
        </div>
    <?php } ?>
        <div class="h-100 d-flex flex-column justify-content-center align-items-center">
            <div class="border rounded-3 shadow-sm p-3 mb-5 bg-body" style="background-color: #fff; width: 450px;">
                <h4 class="text-center mt-4" style="font-family: Spectral;">Welcome Back</h4>
                <p class="text-center mb-5" style="font-family: 'Roboto Mono'; font-size: 14px;">Siperpus paling perpus</p>
                <form action="/users/login" method="post">
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person" style="font-size: 14px;"></i></span>
                        <div class="col-9">
                        <input type="text" class="form-control col-xs-2" placeholder="Username" aria-label="Username" name="id" aria-describedby="basic-addon1" value="<?= $_POST['id'] ?? "" ?>" style="font-family:'Roboto Mono'; font-size: 14px;">
                        </div>
                      </div>
    
                      <div class="input-group mb-4 d-flex justify-content-center">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"  style="font-size: 14px;"></i></span>
                        <div class="col-9">
                        <input type="password" class="form-control col-xs-2" placeholder="Password" name="password" aria-describedby="basic-addon1" style="font-family:'Roboto Mono'; font-size: 14px;">
                        </div>
                      </div>
    
                      <div class="d-grid gap-2 col-10 mx-auto mt-3 mb-4">
                        <button class="btn" type="submit" style="background-color:#2a7cf3; color: #fff; font: 14px 'Roboto Mono';">Sign In</button>
                      </div>
                </form>
            </div>
            <div>
                <p style="font: 14px 'Roboto Mono';">Don't have an account? <a href="/users/register" class="link-dark text-decoration-none"><b>Create Account!</b></a></p>
            </div>
          </div>
    </section>