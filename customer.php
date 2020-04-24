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
    <title>customer</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
    add = () =>{
        document.getElementById('action').value = "insert";
        document.getElementById('id_customer').value = "";
        document.getElementById('nama').value = "";
        document.getElementById('alamat').value = "";
        document.getElementById('kontak').value = "";
        document.getElementById('username').value = "";
        document.getElementById('password').value = "";
    }
    edit = (item) =>{
        document.getElementById('action').value = "update";
        document.getElementById('id_customer').value = item.id_customer;
        document.getElementById('nama').value = item.nama;
        document.getElementById('alamat').value = item.alamat;
        document.getElementById('kontak').value = item.kontak;
        document.getElementById('username').value = item.username;
        document.getElementById('password').value = item.password;
    }
    </script>
    <style>
        .header{
            background-image:  url("customer2.jpg")  ;
            background-size: cover;
            height:120vh ;
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
            $sql = "select * from customer where id_customer like '%$cari%'
            or nama like '%$cari%'
            or alamat like '%$cari%'
            or kontak like '%$cari%'
            or username like '%$cari%'
            or password like '%$cari%'";
        }else{
            $sql = "select * from customer";
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
                <li class="nav-item"><h4><a href="http://localhost/toko%20buku/buku.php" class="nav-link">Daftar Buku</a></h4></li>
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

    <div class="">
        <!--card-->
        <div class="card">
            <div class="card-header bg-danger text-center">
                <h3>Customer</h3>
            </div>
            <!--body-->
            <div class="card-body">
                <table class="table border">
                    <thead>
                        <th>ID Customer</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kontak</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Option</th>
                    </thead>
                    <tbody>
                    <?php 
                    
                    foreach ($query as $customer):
                     ?>
                <tr>
                    <td><?php echo $customer["id_customer"] ?></td>
                    <td><?php echo $customer["nama"] ?></td>
                    <td><?php echo $customer["alamat"] ?></td>
                    <td><?php echo $customer["kontak"] ?></td>
                    <td><?php echo $customer["username"] ?></td>
                    <td><?php echo $customer["password"] ?></td>
                    
                    <td>
                    <button data-toggle="modal" data-target="#modal_customer" type="button" class="btn btn-sm btn-info"
                    onclick='edit(<?php echo json_encode($customer);?>)'>
                        Edit 
                    </button>
                   <a href="proses_crud_customer.php?hapus=true&id_customer=<?php echo $customer["id_customer"];?>"
                   onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">
                        <button type="button" class="btn btn-sm btn-danger">
                            hapus 
                        </button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
                    </tbody>
                </table>
                <button data-toggle="modal" data-target="#modal_customer" type="button" class="btn btn-sm btn-success"
    onclick="add()">
        tambah data
    </button>
        </div>
    </div>
    <!--end card-->

    <!--form modal-->
    <div class="modal fade" id="modal_customer">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="proses_crud_customer.php"
                method="post" enctype="multipart/form.data">
                <div class="modal-header bg-danger text-white">
                    <h4>Customer</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" id="action">
                    ID Customer
                    <input type="number" name="id_customer" id="id_customer"
                    class="form-control" required />
                    Nama
                    <input type="text" name="nama" id="nama"
                    class="form-control" required />
                    Alamat
                    <input type="text" name="alamat" id="alamat"
                    class="form-control" required />
                    Kontak
                    <input type="text" name="kontak" id="kontak"
                    class="form-control" required />
                    Username 
                    <input type="text" name="username" id="username"
                    class="form-control" required />
                    Password
                    <input type="password" type="hidden" name="password" id="password"
                    class="form-control" required />
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_customer"
                    class="btn btn-primary">
                    Simpan
                </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>