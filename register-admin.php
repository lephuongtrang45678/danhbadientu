<?php
include('./register/header-register.php');
ob_start()
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <section class="vh-100">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-lg-12 col-xl-11">
                            <div class="card text-black" style="border-radius: 25px;">
                                <div class="card-body p-md-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10 col-xl-6 order-2 order-lg-1">

                                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4 text-danger">ĐĂNG KÝ</p>
                                            <?php
                                            if (isset($_GET['reply'])) {
                                                if ($_GET['reply'] == 'successfully') {
                                                    echo "<p>Bạn đã đăng kí thành công</p>";
                                                } else {
                                                    echo "<p>Email đã tồn tại</p>";
                                                }
                                            }
                                            ?>

                                            <form class="mx-1 mx-md-4" method="POST" enctype="multipart/form-data">
                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="text" id="firstName" name="firstName" class="form-control" value="Lê" />
                                                        <label class="form-label" for="firstName">Họ</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="text" id="lastName" name="lastName" class="form-control" value="Phương Trang" />
                                                        <label class="form-label" for="lastName">Tên</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="file" name="fileToUpload" id="fileToUpload" class="  form-control" value="chọn ảnh">
                                                        <label class="form-label" for="avatar">Chọn ảnh</label>
                                                        <div class="mb-3">
                                                            <img src="<?php echo $row['avatar']; ?>" alt="" style="width : 10%">
                                                        </div>
                                                        <div class="preview mb-3">
                                                            <div id="preview">
                                                                <img src="#" hidden />
                                                            </div>
                                                            <div id="err"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="email" id="email" name="email" class="form-control" value="abc123@gmail.com" />
                                                        <label class="form-label" for="email"> Email của Bạn</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="password" id="pass1" name="pass1" class="form-control" />
                                                        <label class="form-label" for="pass1">Mật Khẩu</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="password" id="pass2" name="pass2" class="form-control" />
                                                        <label class="form-label" for="pass2"> Nhập lại mật khẩu của bạn</label>
                                                    </div>
                                                </div>



                                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                    <input type="submit" value="ĐĂNG KÝ" class="btn btn-outline-danger btn-lg" name="submit">
                                                </div>

                                            </form>

                                        </div>
                                        <div class="col-md-10 col-xl-6 d-flex align-items-center order-1 order-lg-2">

                                            <img src="https://nhadat24h.com/uploads/truonghoc/truongdaihocthuyloi.jpg" class="img-fluid" alt="Sample image">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    $target_dir = "upload/user-img/"; //chỉ định thư mục nơi tệp sẽ được đặt
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

    include('./register/constants.php');

    $sql = "SELECT * FROM users WHERE email='$email' ";

    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {

        echo $value = 'đăng ký thất bại';
        header("Location:register-admin.php?response=$value");
    } else {
        $string = rand();
        $code = md5($string);
        $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
        $sql2  = "INSERT INTO users (first_name, last_name, avatar, email, password, code ) 
            VALUES ('$first_name','$last_name', '$target_file', '$email','$pass_hash', '$code')";
        $res2 = mysqli_query($conn, $sql2); // voi lenh insert thanh cong tra ve so nguyen
        if ($res2 > 0) {
            require './sendEmailv1/Exception.php';
            require './sendEmailv1/PHPMailer.php';
            require './sendEmailv1/SMTP.php';

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
                $mail->isSMTP(); // gửi mail SMTP
                $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'lephuongtrang45678@gmail.com'; // SMTP username
                $mail->Password = 'tyajhtyhonkocefz'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port = 587; // TCP port to connect to
                $mail->CharSet = 'UTF-8';
                //Recipients
                $mail->setFrom('lephuongtrang45678@gmail.com', 'DANH BẠ THỦY LỢI');

                $mail->addReplyTo('lephuongtrang45678@gmail.com', 'DANH BẠ THỦY LỢI');

                $mail->addAddress($email); // Add a recipient


                // Content
                $mail->isHTML(true);   // Set email format to HTML
                $tieude = 'Xác nhận tài khoản';
                $mail->Subject = $tieude;
                // gui ve thong bao                   
                $linkemail = "http://localhost/danhba/active_user.php?email=" . $email . "&code=" . $code;
                // Mail body content 
                $bodyContent .= '<p><b>Hãy xác nhận email đăng ký tài khoảng Danh bạ đại học Thủy Lợi</b></p>';
                $bodyContent .= '<a href=' . $linkemail . '>Kích hoạt</a>';


                $mail->Body = $bodyContent;
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                if ($mail->send()) {
                    echo 'Thư đã được gửi đi, vào Email Email kiểm tra!';
                } else {
                    echo 'Lỗi. Thư chưa gửi được';
                }
            } catch (Exception $e) {
                echo "Thư không thể gửi được . Mailer lỗi: {$mail->ErrorInfo}";
            }

            $value = 'đăng ký thành công';
            header("Location:login.php?response=$value");
        }
    }
}
include('./register/footer.php')
?>
<script type="text/javascript" src="edit-js.js"></script>