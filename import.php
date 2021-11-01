<?php  
include("./CONFIG/constants.php");
    if($_FILES["upload-nhanvien"]["name"])
    { 
        // $conn = mysqli_conn("localhost", "root", "", "danhba");  
        $output = '';  
        $allowed_ext = array("csv");  
        $extension = explode(".", $_FILES["upload-nhanvien"]["name"]);  
        $end_ex =end($extension);
        if(in_array($end_ex, $allowed_ext))  
        {  
            $file_data = fopen($_FILES["upload-nhanvien"]["tmp_name"], 'r');  
            fgetcsv($file_data);  
            while($row = fgetcsv($file_data))  
            {
                
                    $tennv = mysqli_real_escape_string($conn, $row[0]);  
                    $chucvu = mysqli_real_escape_string($conn, $row[1]);  
                    $sodidong = mysqli_real_escape_string($conn, $row[2]);  
                    $email = mysqli_real_escape_string($conn, $row[3]);  
                    $madv = mysqli_real_escape_string($conn, $row[4]);  
                    $query = "  
                    INSERT INTO db_nhanvien  
                        (tennv, chucvu, email, sodidong, madv)  
                        VALUES ('$tennv', '$chucvu', '$email', '$sodidong', '$madv')  
                    ";  
                    mysqli_query($conn, $query);  
                    echo $query;
            }  
        //     $select = "SELECT * FROM db_nhanvien  ORDER BY manv DESC";  
        //     $result = mysqli_query($conn, $select);  
        //     $output .= '  
        //             <table class="table table-bordered">  
        //                 <tr>
        //                 <th scope="col">STT</th>
        //                 <th scope="col">Mã nhân viên</th>
        //                 <th scope="col">Họ và tên</th>
        //                 <th scope="col">Chức vụ</th>
        //                 <th scope="col">Số di động</th>
        //                 <th scope="col">Email</th>
        //                 <th scope="col">Tên đơn vị</th>
        //                 <th scope="col">Sửa</th>
        //                 <th scope="col">Xóa</th>
        //                 <th scope="col" style="width: 10%;">Ảnh đại diện</th>

        //             </tr> 
        //     ';  
        //     while($row = mysqli_fetch_array($result))  
        //     {
        //         $i = 1;
        //             $output .= '  
        //                 <tr>  
        //                     <td>' . $i . '</td>  
        //                     <td>'.$row["manv"].'</td>  
        //                     <td>'.$row["tennv"].'</td>  
        //                     <td>'.$row["chucvu"].'</td>  
        //                     <td>'.$row["sodidong"].'</td>  
        //                     <td>'.$row["email"].'</td>  
        //                     <td>'.$row["madv"].'</td>  
        //                 </tr>  
        //             ';  
        //     }  
        //     $output .= '</table>';  
        //     echo $output;  
        // }  
        // else  
        // {  
        //     echo 'Error1';  
        } 
    }
    else  
    {  
        echo "Error2";  
    }
?>
