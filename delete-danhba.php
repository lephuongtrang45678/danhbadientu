<?php 

    //Include constants.php file here
    include('CONFIG/constants.php');

    // 1. get the manv of dbnhanvien to be deleted
    $manv = $_GET['manv'];

    //2. Create SQL Query to Delete 
    $sql = "DELETE FROM db_nhanvien WHERE manv='$manv'";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if($res==true)
    {
       $_SESSION['delete'] = "<div class='danger'>xoa thanh cong.</div>";
        header('location:'.SITEURL.'index.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>xoa that bai.</div>";
        header('location:'.SITEURL.'index.php');
    }


?>