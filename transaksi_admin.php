<?php 
    // memanggil file config php
    // agar tidak perlu membuat koneksi baru 
    include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>toko buku</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
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
                <li class="nav-item"><h4><a href="#" class="nav-link">Beranda</a></h4></li>
                <li class="nav-item"><h4><a href="http://localhost/toko%20buku/admin.php" class="nav-link">Admin</a></h4></li>
                <li class="nav-item"><h4><a href="http://localhost/toko%20buku/customer.php" class="nav-link">Customer</a></h4></li>
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
        <div class="card mt-3 col-12" style="position:absolute; top:15%; left:0%;">
            <div class="card-header bg-danger">
                    <h4 class="text-white">Riwayat Transaksi</h4>
            </div>
                <div class="card-body">
                    <?php 
                    $sql = "select * from transaksi t 
                    inner join customer c 
                    on t.id_customer = c.id_customer 
                    where t.id_customer = '".$_SESSION["id_customer"]."'order by t.tgl desc";
                    $query = mysqli_query($connect,$sql);
                    ?>


                    <ul class="list-group">
                        <?php foreach ($query as $transaksi): ?>
                            <h6>ID transaksi: <?php echo $transaksi["id_transaksi"]; ?></h6>
                            <h6>Nama Pembeli: <?php echo $transaksi["nama"]; ?></h6>
                            <h6>Tgl. Transaksi: <?php echo $transaksi["tgl"]; ?></h6>
                            <h6>List Barang</h6>

                            <?php 
                            $sql2 = "select * from detail_transaksi d inner join buku b 
                            on d.kode_buku = b.kode_buku 
                            where d.id_transaksi= '".$transaksi["id_transaksi"]."'";
                            $query2 = mysqli_query($connect, $sql2);
                            ?>

                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0; foreach ($query2 as $detail): ?>
                                    <tr>
                                        <td><?php echo $detail["judul"]; ?></td>
                                        <td><?php echo $detail["jumlah"]; ?></td>
                                        <td>Rp <?php echo number_format ($detail["harga_beli"]); ?></td>
                                        <td>
                                            Rp <?php echo number_format($detail["harga_beli"]*$detail["jumlah"]); ?>
                                        </td>
                                    </tr>
                                <?php 
                                $total += ($detail["harga_beli"]*$detail["jumlah"]);
                            endforeach; ?>
                                </tbody>
                            </table>

                            <h6 class="text-danger">Total: Rp <?php echo number_format($total); ?></h6>

                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
    </div>   
</body>