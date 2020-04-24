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

    add = () =>{
        document.getElementById('action').value = "insert";
        document.getElementById('kode_buku').value = "";
        document.getElementById('judul').value = "";
        document.getElementById('penulis').value = "";
        document.getElementById('tahun').value = "";
        document.getElementById('harga').value = "";
        document.getElementById('stok').value = "";
    }
    edit = (item) =>{
        document.getElementById('action').value = "update";
        document.getElementById('kode_buku').value = item.kode_buku;
        document.getElementById('judul').value = item.judul;
        document.getElementById('penulis').value = item.penulis;
        document.getElementById('tahun').value = item.tahun;
        document.getElementById('harga').value = item.harga;
        document.getElementById('stok').value = item.stok;
    }
    </script>
    <style>
        .header{
            background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url("library.jpg")  ;
            background-size: cover;
            height:100vh ;
            background-position: center;
            color: white;
            }
    .title{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50px;
            color: #f8f3e6;
            }
    .footer{
        background: green;
        color: black;
        width: 100%;
        height: 30px;
    }
    </style>
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

    <div class="header"></div>
    <div class="title">
        <h1><u>TOKO BUKU</u></h1>
    </div>

    <div class="row">
        <?php foreach ($query as $buku): ?>
        <div class="card col-4">
        <div class="card-body">
        <img src="<?php echo 'image/'.$buku['image'];?>" width="150">
        <h5 class="text-success"><?php echo $buku["judul"]; ?></h5>
        <h6 class="text-secondary">Rp <?php echo $buku["harga"]; ?></h6>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-sm btn-info"
            onclick='Detail(<?php echo json_encode($buku); ?>)'
            data-toggle="modal" data-target="#modal_detail">
            Detail
            </button>
        </div>
    </div>
        <?php endforeach; ?>
</div>

<div class="modal" id="modal_detail">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-dark">
    <h4 class="text-white">detail buku</h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-6">
            <img id="image" style="width:100%; height:auto;">
</div>
            <div class="col-6">
                <h4 id="judul"></h4>
                <h4 id="penulis"></h4>
                <h4 id="harga"></h4>
                <h4 id="stok"></h4>

                <form action="proses_cart.php" method="post">
                    <input type="hidden" name="kode_buku" id="kode_buku">
                    Jumlah beli
                    <input type="number" name="jumlah_beli" id="jumlah_beli"
                    class="form-control" min="1" >
                    <button type="submit" name="add_to_cart" class="btn btn-success">
                    Tambah ke keranjang
                    </button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

    
        </div>
    </div>
</body>
</html>