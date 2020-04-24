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

    <div class="header"></div>
    <div class="title">
        <h1><u>TOKO BUKU</u></h1>
    </div>

    <div class="">
        <!--card-->
        <div class="card">
            <div class="card-header bg-danger text-center">
                <h3>BUKU</h3>
            </div>
            <!--body-->
            <div class="card-body">
                <table class="table border">
                    <thead>
                        <th>kode buku</th>
                        <th>judul</th>
                        <th>penulis</th>
                        <th>tahun</th>
                        <th>harga</th>
                        <th>stok</th>
                        <th>image</th>
                        <th>option</th>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($query as $buku):
                     ?>
                <tr>
                    <td><?php echo $buku["kode_buku"] ?></td>
                    <td><?php echo $buku["judul"] ?></td>
                    <td><?php echo $buku["penulis"] ?></td>
                    <td><?php echo $buku["tahun"] ?></td>
                    <td><?php echo $buku["harga"] ?></td>
                    <td><?php echo $buku["stok"] ?></td>
                    
                    <td>
                        <img src="<?php echo 'image/'.$buku['image'];?>" alt="image" width="200">
                    </td>

                    <td>
                    <button data-toggle="modal" data-target="#modal_buku" type="button" class="btn btn-sm btn-info"
                    onclick='edit(<?php echo json_encode($buku);?>)'>
                        edit 
                    </button>
                   <a href="proses_crud_buku.php?hapus=true&kode_buku=<?php echo $buku["kode_buku"];?>"
                   onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">
                        <button type="button" class="btn btn-sm btn-danger">
                            hapus 
                        </button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
                    </tbody>
                </table>
                <button data-toggle="modal" data-target="#modal_buku" type="button" class="btn btn-sm btn-success"
    onclick="add()">
        tambah data
    </button>
        </div>
    </div>
    <!--end card-->

    <!--form modal-->
    <div class="modal fade" id="modal_buku">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="proses_crud_buku.php"
                method="post" enctype="multipart/form-data">
                <div class="modal-header bg-danger text-white">
                    <h4>TOKO BUKU</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" id="action">
                    kode_buku
                    <input type="number" name="kode_buku" id="kode_buku"
                    class="form-control" required />
                    judul
                    <input type="text" name="judul" id="judul"
                    class="form-control" required />
                    penulis
                    <input type="text" name="penulis" id="penulis"
                    class="form-control" required />
                    tahun
                    <input type="text" name="tahun" id="tahun"
                    class="form-control" required />
                    harga
                    <input type="text" name="harga" id="harga"
                    class="form-control" required />
                    stok
                    <input type="text" name="stok" id="stok"
                    class="form-control" required />
                    image 
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_buku"
                    class="btn btn-primary">
                    simpan
                </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>