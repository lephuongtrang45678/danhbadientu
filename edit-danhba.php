<?php
include("header.php");
?>

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col d-flex"><a href="index.php"><i class="fas fa-chevron-left "></i></a>
            <h4 class="ms-2">Trở lại thông tin danh bạ</h4>
        </div>
        <div class="col text-end"><a href="./index.php"><button class="btn btn-outline-danger" type="submit">Hủy</button></a></div>
    </div>
    <?php
    if (isset($_GET['manv'])) {
        $manv = $_GET['manv'];
    }

    $sql_2 = " SELECT * FROM db_nhanvien WHERE manv = '$manv'";
    $res_2 = mysqli_query($conn, $sql_2);

    $row_2 = mysqli_fetch_assoc($res_2);
    ?>

    <div class="row mt-4 ">
        <form class="d-flex w-25 text-end">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-danger" type="submit">Search</button>
        </form>
    </div>
    <div class="row">
        <div class="col border p-3 rounded-2 mt-3">
            <form method="POST" class="row g-3 " enctype="multipart/form-data" id="form">
                <div class="col-md-4">
                    <label for="manv" class="form-label">Mã nhân viên</label>
                    <input type="text" name="manv" class="form-control" id="manv" value="<?php echo $row_2['manv']; ?>">
                </div>
                <div class="col-md-4">
                    <label for="tennv" class="form-label">Họ và tên</label>
                    <input type="text" name="tennv" class="form-control" id="tennv" value="<?php echo $row_2['tennv']; ?>">
                </div>
                <div class="col-md-4">
                    <label for="chucvu" class="form-label">Chức vụ</label>
                    <input type="" name="chucvu" class="form-control" id="chucvu" value="<?php echo $row_2['chucvu']; ?>">
                </div>
                <div class="col-md-4">
                    <label for="sdt" class="form-label">Số di động</label>
                    <input type="tel" name="sodidong" class="form-control" id="sodidong" value="<?php echo $row_2['sodidong']; ?>">
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $row_2['email']; ?>">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Tên đơn vị</label>
                    <select id="inputState" class="form-select" name="madv">
                        <?php
                        $sql = "SELECT * FROM db_donvi";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['madv'] == $row_2['madv']) {
                                    echo '<option value ="' . $row['madv'] . '" selected>' . $row['tendv'] . '</option>';
                                } else {
                                    echo '<option value ="' . $row['madv'] . '" >' . $row['tendv'] . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="avatar" class="form-label">Thay đổi ảnh</label>
                    <div class="mb-3">
                        <img src="<?php echo $row_2['avatar']; ?>" alt="" style="width : 10%">
                    </div>
                    <input type="file" id="fileToUpload" name="fileToUpload" accept="images/*" class=" mb-3 form-control" value="chọn ảnh">
                    <div class="preview mb-3">
                        <div id="preview">
                            <img src="#" hidden  />
                        </div>
                        <div id="err"></div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center mt-3">
                    <button type="submit" name="submit" class="btn btn-outline-danger ">
                        <h5>Sửa</h5x>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php
    include("footer.php");
    if (isset($_POST['submit'])) {


        //echo "CLicked";

        //1. Get the DAta from Form
        $manv = $_POST['manv'];
        $tennv = $_POST['tennv'];
        $chucvu = $_POST['chucvu'];
        $sodidong = $_POST['sodidong'];
        $email = $_POST['email'];
        $madv = $_POST['madv'];


        $target_dir = "user-img/"; //chỉ định thư mục nơi tệp sẽ được đặt
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); //chỉ định đường dẫn của tệp sẽ được tải lên
        $uploadOk = 1; //chưa được sử dụng (sẽ được sử dụng sau)
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //giữ phần mở rộng tệp của tệp 

        // Kiểm tra xem tệp đã tồn tại chưa
        if (file_exists($target_file)) {
            echo "Xin lỗi, ảnh bạn đã tồn tại.";
            $uploadOk = 0;
        }

        // kiểm tra kích cỡ ảnh
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Xin lỗi,cỡ ảnh bạn quá lớn.";
            $uploadOk = 0;
        }

        // cho phép các dạng form ảnh
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo " Xin lỗi, chỉ có tệp JPG, JPG, PNG & GIF được phép.";
            $uploadOk = 0;
        }

        // kiểm tra nếu $uploadOk = 0
        if ($uploadOk == 0) {
            echo "Xin lỗi, tập tin của bạn đã không được tải lên.";
            // Hoàn thành tải lên tập tin PHP Script
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Tệp " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " đã thành công.";
            } else {
                echo "Xin lỗi, đã có lỗi tải lên tệp của bạn.";
            }
        }
        // echo $avatar;
        // update
        include('./CONFIG/constants.php');
        $sql = "SELECT * FROM db_nhanvien WHERE manv=$manv ";
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $sql2 = "UPDATE db_nhanvien set  tennv='$tennv', chucvu='$chucvu', sodidong='$sodidong', email='$email', madv='$madv', avatar = '$target_file' where manv = '$manv'";
                $res2 = mysqli_query($conn, $sql2);
                if ($res2 == true) {
                    //Display Succes Message
                    //REdirect to Manage Admin Page with Success Message
                    $_SESSION['edit'] = "<div class='success'> Changed Successfully. </div>";
                    //Redirect the User
                    header('location:' . SITEURL . 'index.php');
                } else {
                    //Display Error Message
                    //REdirect to Manage Admin Page with Error Message
                    $_SESSION['edit'] = "<div class='error'>Failed to Change . </div>";
                    //Redirect the User
                    header('location:' . SITEURL . 'edit-danhba.php');
                }
            }
        }
    }

    ?>
    <script type="text/javascript" src="edit-js.js"></script>