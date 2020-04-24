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
        document.getElementById('id_admin').value = "";
        document.getElementById('nama').value = "";
        document.getElementById('kontak').value = "";
        document.getElementById('username').value = "";
        document.getElementById('password').value = "";
    }
    edit = (item) =>{
        document.getElementById('action').value = "update";
        document.getElementById('id_admin').value = item.id_admin;
        document.getElementById('nama').value = item.nama;
        document.getElementById('kontak').value = item.kontak;
        document.getElementById('username').value = item.username;
        document.getElementById('password').value = item.password;
    }
    </script>
    <style>
        .header{
            background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url("buku.jpg")  ;
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
            $sql = "select * from admin where id_admin like '%$cari%'
            or kontak like '%$cari%'
            or nama like '%$cari%'
            or password like '%$cari%'
            or username like '%$cari%'";
        }else{
            $sql = "select * from admin";
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
                <li class="nav-item"><h4><a href="http://localhost/toko%20buku/buku.php" class="nav-link">Daftar Buku</a></h4></li>
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
        <h1><u>ADMIN TOKO BUKU</u></h1>
    </div>

    <div class="">
        <!--card-->
        <div class="card">
            <div class="card-header bg-danger text-center">
                <h3>Admin</h3>
            </div>
            <!--body-->
            <div class="card-body">
                <table class="table border">
                    <thead>
                        <th>ID ADMIN</th>
                        <th>KONTAK</th>
                        <th>NAMA</th>
                        <th>PASSWORD</th>
                        <th>USERNAME</th>
                        <th>OPTION</th>
                    </thead>
                    <tbody>
                    <?php 
                    
                    foreach ($query as $admin):
                     ?>
                <tr>
                    <td><?php echo $admin["id_admin"] ?></td>
                    <td><?php echo $admin["kontak"] ?></td>
                    <td><?php echo $admin["nama"] ?></td>
                    <td><?php echo $admin["password"] ?></td>
                    <td><?php echo $admin["username"] ?></td>
                    
                    <td>
                    <button data-toggle="modal" data-target="#modal_admin" type="button" class="btn btn-sm btn-info"
                    onclick='edit(<?php echo json_encode($admin);?>)'>
                        edit 
                    </button>
                   <a href="proses_crud_admin.php?hapus=true&id_admin=<?php echo $admin["id_admin"];?>"
                   onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">
                        <button type="button" class="btn btn-sm btn-danger">
                            hapus 
                        </button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
                    </tbody>
                </table>
                <button data-toggle="modal" data-target="#modal_admin" type="button" class="btn btn-sm btn-success"
    onclick="add()">
        tambah data
    </button>
        </div>
    </div>
    <!--end card-->

    <!--form modal-->
    <div class="modal fade" id="modal_admin">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="proses_crud_admin.php"
                method="post" enctype="multipart/form.data">
                <div class="modal-header bg-danger text-white">
                    <h4>form admin</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" id="action">
                    id admin
                    <input type="number" name="id_admin" id="id_admin"
                    class="form-control" required />
                    nama
                    <input type="text" name="nama" id="nama"
                    class="form-control" required />
                    kontak
                    <input type="text" name="kontak" id="kontak"
                    class="form-control" required />
                    username 
                    <input type="text" name="username" id="username"
                    class="form-control" required />
                    password
                    <input type="password" type="hidden" name="password" id="password"
                    class="form-control" required />
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_admin"
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