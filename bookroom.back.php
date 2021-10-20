<?php
require_once('config.php');
$idbookroomreserve = "";
$name = "";
$phone = "";
$num = "";
$date = "";
date_default_timezone_set("Asia/Ho_Chi_Minh");
$regidate= date("Y-m-d H:i:s");
$idrooms = "";
if (isset($_POST['book_input_idrooms'])) {
    $idrooms = mysqli_real_escape_string($conn, $_POST['book_input_idrooms']);
}
$idrooms = mysqli_real_escape_string($conn, $_POST['book_input_idrooms']);
$name = mysqli_real_escape_string($conn, $_POST['book_input_name']);
$phone = mysqli_real_escape_string($conn, $_POST['book_input_phone']);
$num = mysqli_real_escape_string($conn, $_POST['book_input_num']);
$date = mysqli_real_escape_string($conn, $_POST['book_input_date']);
if (isset($_POST['btn_book_submit'])) {
    if ($name != "") {
        if ($phone != "") {
            if (is_numeric($num)) {
                if (intval($num) > 0) {
                    if ($date != "") {
                        if ($date = date_create($date)) {
                            $idbookroomreserve  = date("YmdhiA") . strtoupper(substr(MD5(rand()), 0, 6));
                            $sql = "SELECT * FROM dacs2.`bookroom.reserve` WHERE `idbookroom.reserve` = '$idbookroomreserve'";
                            $rs = mysqli_query($conn, $sql);
                            /* while (mysqli_num_rows($rs) != 0) {
                                $idbookroomreserve  = date("YmdHiA") . strtoupper(substr(MD5(rand()), 0, 6));
                                $sql = "SELECT * FROM dacs2.`bookroom.reserve` WHERE `idbookroom.reserve` = '$idbookroomreserve'";
                                $rs = mysqli_query($conn, $sql);
                            } */
                            if (mysqli_num_rows($rs) != 0) {
                                header('location:index.php');
                                // echo "<script>alert('Trung id')</script>";
                                exit;
                            }
                            $dateymd = date_format($date, "Y-m-d");
                            if ($idrooms == "") {
                                $sql = "INSERT INTO `dacs2`.`bookroom.reserve` (`idbookroom.reserve`, `name`, `phone`, `num`, `date`, `regidate`) VALUES ('$idbookroomreserve', '$name', '$phone', '$num', '$dateymd','$regidate');";
                            } else {
                                $sql = "INSERT INTO `dacs2`.`bookroom.reserve` (`idbookroom.reserve`, `name`, `phone`, `num`, `date`,`regidate`,`idrooms`) VALUES ('$idbookroomreserve', '$name', '$phone', '$num', '$dateymd','$regidate','$idrooms');";
                            }
                            if (mysqli_query($conn, $sql)) {
                                // echo "<script>alert('ok')</script>";
                                header('location:bookroom.php?id=' . $idbookroomreserve);
                                //           echo "sql";
                                //echo " alert('Sql');";
                                exit;
                            } else {
                                header('location:index.php');
                                // echo "<script>alert('sql')</script>";
                                exit;
                            }
                        } else {
                            header('location:index.php');
                            // echo "<script>alert('date2')</script>";
                            exit;
                        }
                    } else {
                        header('location:index.php');
                        // echo "<script>alert('date1')</script>";
                        exit;
                    }
                } else {
                    header('location:index.php');
                    // echo "<script>alert('num2')</script>";
                    exit;
                }
            } else {
                header('location:index.php');
                // echo "<script>alert('num1')</script>";
                exit;
            }
        } else {
            header('location:index.php');
            // echo "<script>alert('phone')</script>";
            exit;
        }
    } else {
        header('location:index.php');
        // echo "<script>alert('name')</script>";
        exit;
    }
} else {
    header('location:index.php');
    // echo "<script>alert('không nhận submit')</script>";
    // echo "không nhận submit";
    exit;
}
