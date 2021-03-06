<?php 
    session_start();
    if (!isset($_SESSION["id_customer"])) {
        header("location:login_customer.php");
    }
    // memanggil file config php
    // agar tidak perlu membuat koneksi baru 
    include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>toko buku customer</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
    Detail = (item) => {
        document.getElementById('kode_buku').value = item.kode_buku;
        document.getElementById('judul').innerHTML = "judul: " + item.judul;
        document.getElementById('penulis').innerHTML = "penulis: " + item.penulis;
        document.getElementById('harga').innerHTML = "harga: " + item.harga;
        document.getElementById('stok').innerHTML = "stok: " + item.stok;
        document.getElementById('jumlah_beli').value = "1";

        document.getElementById("image").src = "image/" + item.image;
        
    }
    </script>
</head>
<?php
if(isset($_POST["cari"])){
            $cari = $_POST["cari"];
            $sql = "select * from buku where kode_buku like '%$cari%'
            or judul like '%$cari%'
            or penulis like '%$cari%'
            or tahun like '%$cari%'
            or harga like '%$cari%'
            or stok like '%$cari%'";
        }else{
            $sql = "select * from buku";
        }
        $query = mysqli_query($connect,$sql);
        ?>

<body>
    <nav class="navbar navbar-expand-md bg-danger navbar-dark fixed-top">
        <a href="#">
            <img src="logobuku2.png" width="150" alt="">
        </a>

        <button type="button" class="navbar-toggler" data-toggle="collapase" data-target="#menu">
            <span class="navbar navbar-toggler-icon"></span>
        </button>

        

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav">
                <li class="nav-item"><h4><a href="tampilan_customer.php" class="nav-link">Beranda</a></h4></li>
                <li class="nav-item"><h4><a href="cart.php" class="nav-link">Cart(<?php echo count($_SESSION["cart"]); ?>)</a></h4></li>
                <li class="nav-item dropdown">
                    <h4>
                    <a href="#" class="nav-link dropdown-toggle" id="Social" data-toggle="dropdown">Social</a>
                    <div class="dropdown-menu">
                        <a href="https://steamcommunity.com/id/junaelek/" class="dropdown-item">Steam</a>
                        <a href="https://www.instagram.com/junaalfath/?hl=id" class="dropdown-item">Instagram</a>
                        <a href="https://twitter.com/junaalfath" class="dropdown-item">Twitter</a>
                    </div>
                    </h4>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
     <div class="card" style="position:absolute; top:30%; left:35%;">
      <div class="card-header bg-danger">
        <h4 class="text-white">Keranjang Belanja Anda</h4>
      </div>
      <div class="card-body">
      <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($_SESSION["cart"] as $cart): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $cart["judul"]; ?></td>
                    <td>Rp <?php echo $cart["harga"]; ?></td>
                    <td><?php echo $cart["jumlah_beli"]; ?></td>
                    <td>Rp <?php echo $cart["jumlah_beli"]*$cart["harga"]; ?></td>
                    <td>
                        <a href="proses_cart.php?hapus=true&kode_buku=<?php echo $cart["kode_buku"]?>"
                        > <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                        </a>
                    </td>
                </tr>
                <?php $no++; endforeach ?>
        </tbody>
      </table>
      <tfoot>
                <a href="proses_cart.php?checkout=true">
                    <button type="button" class="btn btn-success">
                     Checkout
                    </button>
                </a>
      </tfoot>
      </div>
     </div>
    </div>   
</body>
</html>