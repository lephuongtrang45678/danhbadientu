<?php  
    if($_FILES["upload-nhanvien"]["name"])
    { 
        $connect = mysqli_connect("localhost", "root", "", "danhba");  
        $output = '';  
        $allowed_ext = array("csv");  
        $extension = end(explode(".", $_FILES["upload-nhanvien"]["name"]));  
        if(in_array($extension, $allowed_ext))  
        {  
            $file_data = fopen($_FILES["upload-nhanvien"]["tmp_name"], 'r');  
            fgetcsv($file_data);  
            while($row = fgetcsv($file_data))  
            {
                    $tennv = mysqli_real_escape_string($connect, $row[0]);  
                    $chucvu = mysqli_real_escape_string($connect, $row[1]);  
                    $sodidong = mysqli_real_escape_string($connect, $row[2]);  
                    $email = mysqli_real_escape_string($connect, $row[3]);  
                    $madv = mysqli_real_escape_string($connect, $row[4]);  
                    $query = "  
                    INSERT INTO db_nhanvien  
                        (tennv, chucvu, email, sodidong, madv)  
                        VALUES ('$tennv', '$chucvu', '$email', '$sodidong', '$madv')  
                    ";  
                    mysqli_query($connect, $query);  
            }  
            $select = "SELECT * FROM db_nhanvien  ORDER BY manv DESC";  
            $result = mysqli_query($connect, $select);  
            $output .= '  
                    <table class="table table-bordered">  
                        <tr>  
                            <th width="5%">Mã nhân viên</th>  
                            <th width="25%">Họ và tên</th>  
                            <th width="35%">Chức vụ</th>  
                            <th width="10%">Số di động</th>  
                            <th width="20%">Email</th>  
                            <th width="5%">Tên đơn vị</th>  
                        </tr>  
            ';  
            while($row = mysqli_fetch_array($result))  
            {  
                    $output .= '  
                        <tr>  
                            <td>'.$row["manv"].'</td>  
                            <td>'.$row["tennv"].'</td>  
                            <td>'.$row["chucvu"].'</td>  
                            <td>'.$row["email"].'</td>  
                            <td>'.$row["sodidong"].'</td>  
                            <td>'.$row["madv"].'</td>  
                        </tr>  
                    ';  
            }  
            $output .= '</table>';  
            echo $output;  
        }  
        else  
        {  
            echo 'Error1';  
        } 
    }
    else  
    {  
        echo "Error2";  
    }
?>
