<?php
include("header.php");
?>


<div class="container">
    <div class="row-row-1">
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <div class="col mt-5 mb-3">
            <h4>Danh bạ nhân viên và tên đơn vị tại Đại Học Thủy Lợi</h4>
        </div>
        <div class="col border p-3 rounded-2">
            <form class="row g-3 ">
                <div class="col-md-4">
                    <label for="tennv" class="form-label">Tên nhân viên</label>
                    <input type="" class="form-control" id="tennv" placeholder="Kiều Tuấn Dũng">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Chức vụ</label>
                    <select id="inputState" class="form-select">
                        <option selected>Giảng viên</option>
                        <option>Trưởng khoa</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Tên đơn vị</label>
                    <select id="inputState" class="form-select">
                        <option selected>Bộ môn HTT</option>
                        <option>Khoa CNTT</option>
                    </select>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-danger ">
                        <h5>Tìm Kiếm</h5x>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-12 d-flex justify-content-end mt-4">
            <a href="./add-danhba.php" class="">
                <button type="submit" name="submit" class="btn btn-danger ">
                    <h5>Thêm</h5x>
                </button>
            </a>
        </div>
        <form id="upload_csv" method="post" enctype="multipart/form-data">
            <div class="col">
                <br />
                <label>
                    <h4>Tải danh sách danh bạ nhân viên</h4>
                </label>
            </div>
            <div class="col-md-4">
                <input type="file" name="upload-nhanvien" style="margin-top:15px;" class="btn btn-outline-danger" />
            </div>
            <div class="col-md-5">
                <input type="submit" name="upload" id="upload" value="Tải lên" style="margin-top:10px;" class="btn btn-danger" />
            </div>
            <div style="clear:both"></div>
        </form>
        <div class="col mt-5" id="table-nhanvien">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã nhân viên</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Chức vụ</th>
                        <th scope="col">Số di động</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tên đơn vị</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                        <th scope="col" style="width: 10%;">Ảnh đại diện</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    //lấy dữ liệu từ CSDL và để ra bảng (phần lặp lại)
                    //bước 1:kết nối tời csdl(mysql) 
                    //bước 2 khai báo câu lệnh thực thi và thực hiện truy vấn
                    $sql = "SELECT nv.manv, nv.tennv, nv.chucvu, nv.email, nv.sodidong, dv.tendv, nv.avatar FROM db_nhanvien nv, db_donvi dv WHERE nv.madv = dv.madv order by manv";
                    $result = mysqli_query($conn, $sql);

                    //bước 3 xử lý kết quả trả về
                    if (mysqli_num_rows($result) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                            <tr>
                                <th scope="row"><?php echo $i; ?> </th>
                                <td><?php echo $row['manv']; ?> </td>
                                <td><?php echo $row['tennv']; ?> </td>
                                <td><?php echo $row['chucvu']; ?> </td>
                                <td><?php echo $row['sodidong']; ?> </td>
                                <td><?php echo $row['email']; ?> </td>
                                <td><?php echo $row['tendv']; ?> </td>
                                <td><a href="edit-danhba.php?manv=<?php echo $row['manv']; ?>"><i class="fas fa-edit text-danger"></i></a></td>
                                <td><a href="delete-danhba.php?manv=<?php echo $row['manv']; ?>"><i class="fas fa-trash text-danger"></i></a></td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <img src="<?php echo $row['avatar']; ?>" alt="" style=" width: 50%;" ">
                                    </div>

                                </td>
                            </tr>
                    <?php
                            $i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include('footer.php')
?>
    <script type=" text/javascript" src="edit-js.js"></script>