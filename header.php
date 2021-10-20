<?php
include('config/constants.php');
ob_start();
include('./admin/check_login.php')
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>danh bạ điện tử DHTL</title>
    <link rel="stylesheet" href="./main.css" class="">
</head>

<body>
    <div class="container">
        <div class="row header">
            <?php

            // $sql = " SELECT * FROM db_nhanvien WHERE manv = '$manv'";
            // $res = mysqli_query($conn, $sql);

            // $row = mysqli_fetch_assoc($res);
            ?>
            <div class="col-4">
                <img src="img/logo.png" class="img-fluid" alt="...">
            </div>
            <div class="col-8 text-end mt-2">
                <div class="row ">
                    <div class="col-12">
                        <a href="#"><img src="./img/vi.jpg" alt="" class=""></a>
                        <a href="#"><img src="./img/en.jpg" alt="" class=""></a>

                        <a href="./admin/logout.php" class="text-decoration-none border-start border-2 ps-2 text-danger">Đăng xuất</a>
                    </div>

                    <div class="col-12 mt-2">
                        <img src="<?php echo $row['avatar']; ?>" alt="" style="width: 6%; border-radius: 4px;">
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="container">
        <div class="row nav mt-5">
            <div class="col">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="./index.php">Trang chủ</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Thông báo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Đào tạo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Giới thiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Tuyển sinh</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Nghiên cứu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Văn bản</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">liên hệ</a>
                                </li>
                            </ul>
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-danger" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>