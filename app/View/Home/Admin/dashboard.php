<div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark ">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sticky-top">
                    <h1 class="mt-3 border-bottom">SIPERPUS</h1>
                    <ul class="nav nav-pills flex-column mb-auto mt-5">
                        <li class="mb-3"><a href="index.html" class="text-decoration-none text-white">Dashboard</a></li>
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
            <div class="col py-3">
                <h1>Dashboard Admin</h1>

                <div class="d-flex justify-content-around mt-5 mb-5">

                    <div class="card border-dark" style="width: 200px;">
                        <div class="card-body">
                              <h6 class="card-subtitle mb-2">Anggota</h6>
                              <p class="card-text" style="font-size: 50px;">20</p>
                        </div>
                      </div>
                      <div class="card border-dark" style="width: 200px;">
                        <div class="card-body">
                              <h6 class="card-subtitle mb-2 ">Buku</h6>
                              <p class="card-text" style="font-size: 50px;">100</p>
                        </div>
                      </div>
                      <div class="card border-dark" style="width: 200px;">
                        <div class="card-body">
                              <h6 class="card-subtitle mb-2 ">Peminjaman</h6>
                              <p class="card-text" style="font-size: 50px;">5</p>
                        </div>
                      </div>
                      <div class="card border-dark" style="width: 200px;">
                        <div class="card-body">
                              <h6 class="card-subtitle mb-2 ">Pengembalian</h6>
                              <p class="card-text" style="font-size: 50px;">2</p>
                        </div>
                      </div>
                </div>

                <div>
                  <canvas id="myChart" height="70px" aria-label="Hello ARIA World" role="img"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
      
      const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
      ];

      const ctx = document.getElementById('myChart');

      const myChart = new Chart(ctx, {

        data: {
          labels: labels,
          datasets: [{
          type: 'line',
          label: 'Data Peminjaman Buku',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: [0, 10, 5, 2, 20, 30, 35, 28, 10, 5, 34, 15],
        }, {
          type: 'bar',
          label: 'Data Pengembalian Buku',
          backgroundColor: 'rgb(82, 255, 255, 0.3)',
          borderColor: 'rgb(255, 99, 132)',
          data: [5, 10, 8, 12, 5, 5, 2, 15, 19, 10, 12, 0],
        }]
        },
        options: {}
      });
    </script>