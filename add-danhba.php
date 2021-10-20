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

    if (isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
    {
        echo $_SESSION['add']; //Display the SEssion Message if SEt
        unset($_SESSION['add']); //Remove Session Message
    }


    ?>
    <div class="row">
        <div class="col border p-3 rounded-2 mt-3">
            <form method="POST" class="row g-3 " enctype="multipart/form-data">
                <div class="col-md-4">
                    <label for="manv" class="form-label">Mã nhân viên</label>
                    <input type="" name="manv" class="form-control" id="manv" placeholder="1">
                    <div class="text-muted"><small>Mã đơn vị không trung mã đơn vị đã có</small></div>
                </div>
                <div class="col-md-4">
                    <label for="tennv" class="form-label">Họ và tên</label>
                    <input type="" name="tennv" class="form-control" id="tennv" placeholder="Kiều Tuấn Dũng">
                </div>
                <div class="col-md-4">
                    <label for="chucvu" class="form-label">Chức vụ</label>
                    <input type="" name="chucvu" class="form-control" id="chucvu" placeholder="Giảng viên">
                </div>
                <div class="col-md-4">
                    <label for="sdt" class="form-label">Số di động</label>
                    <input type="tel" name="sodidong" class="form-control" id="sodidong" placeholder="0868600513">
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="dungkt@tlu.edu.vn">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Tên đơn vị</label>
                    <select id="inputState" class="form-select" name="madv">
                        <?php
                        require("CONFIG/constants.php");
                        $sql = "SELECT * FROM db_donvi";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value ="' . $row['madv'] . '">' . $row['tendv'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="avatar" class="form-label">Thay đổi ảnh</label>
                    <div class="mb-3">
                        <img src="<?php echo $row['avatar']; ?>" alt="" style="width : 10%">
                    </div>
                    <input type="file" name="fileToUpload" id="fileToUpload" class=" mb-3 form-control" value="chọn ảnh">
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" name="submit" class="btn btn-outline-danger ">
                        <h5>Thêm</h5x>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include("footer.php");



//Process the Value from Form and Save it in Database

//Check whether the submit button is clicked or not

if (isset($_POST['submit'])) {


    //echo "CLicked";

    //1. Get the DAta from Form
    $manv = $_POST['manv'];
    $tennv = $_POST['tennv'];
    $chucvu = $_POST['chucvu'];
    $sodidong = $_POST['sodidong'];
    $email = $_POST['email'];
    $madv = $_POST['madv'];


    $target_dir = "upload/upload-img/"; //chỉ định thư mục nơi tệp sẽ được đặt
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); //chỉ định đường dẫn của tệp sẽ được tải lên
    $uploadOk = 1; //chưa được sử dụng (sẽ được sử dụng sau)
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //giữ phần mở rộng tệp của tệp 

    // Kiểm tra xem tệp đã tồn tại chưa
    if (file_exists($target_file)) {
        echo "Xin lỗi, ảnh bạn đã tồn tại.";
        $uploadOk = 0;
    }

    // kiểm tra kích cỡ ảnh
    if (
        $_FILES["fileToUpload"]["size"] > 500000
    ) {
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
    require('./CONFIG/constants.php');
    //2. SQL Query to Save the data into database
    $sql = "INSERT INTO db_nhanvien(manv, tennv, chucvu, mayban, email, sodidong, madv, avatar) 
        VALUES (NULL,'$tennv','$chucvu',NULL,'$email','$sodidong','$madv', '$target_file')";
    //3. Executing Query and Saving Data into Datbase
    $res = mysqli_query($conn, $sql);

    //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
    if ($res == TRUE) {
        //Data Inserted

        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='danger'>thêm thành công</div>";
        header("location: index.php");
    } else {

        $_SESSION['add'] = "<div class='error'>không hợp lệ</div>";
        //Redirect Page to Add Admin
        header("location: add-danhba.php");
    }
}

?>