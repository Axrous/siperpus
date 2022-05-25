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
            <div class="col py-3 px-5">
            <div class="col py-3">
                <h1><?=$model['titleBook']?></h1>

                <div class="container disable">
                    <!-- <object id="pdf" width="100%" height="800" type="application/pdf" data="../Pertemuan8_ArgaSatyaM.pdf#toolbar=0" id="pdf_content"></object> -->
                </div>
                <!-- <iframe src="/book/<?=$model['book']?>#toolbar=0&navpanes=0" width="100%" height="800px" onload="injectJS()"></iframe> -->
                <embed src="/book/<?=$model['book']?>#toolbar=0&navpanes=0" type="application/pdf" width="100%" height="800px">
            </div>
        </div>
    </div>
  </div>
  <script type="text/javascript">
document.onmousedown = disableRightclick;
var message = "Right click not allowed !!";
function disableRightclick(evt){
    if(evt.button == 2){
        alert(message);
        return false;    
    }
}
</script>