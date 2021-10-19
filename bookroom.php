<?php
require_once('config.php');
$idbookroomreserve = "";
$name = "";
$phone = "";
$num = "";
$date = "";
$idrooms = "";
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
                            $idbookroomreserve  = date("YmdHiA") . strtoupper(substr(MD5(rand()), 0, 6));
                            $sql = "SELECT * FROM dacs2.`bookroom.reserve` WHERE `idbookroom.reserve` = '$idbookroomreserve'";
                            $rs = mysqli_query($conn, $sql);
                            /* while (mysqli_num_rows($rs) != 0) {
                                $idbookroomreserve  = date("YmdHiA") . strtoupper(substr(MD5(rand()), 0, 6));
                                $sql = "SELECT * FROM dacs2.`bookroom.reserve` WHERE `idbookroom.reserve` = '$idbookroomreserve'";
                                $rs = mysqli_query($conn, $sql);
                            } */
                            $dateymd = date_format($date, "Y-m-d");
                            if ($idrooms == "") {
                                $sql = "INSERT INTO `dacs2`.`bookroom.reserve` (`idbookroom.reserve`, `name`, `phone`, `num`, `date`) VALUES ('$idbookroomreserve', '$name', '$phone', '$num', '$dateymd');";
                                mysqli_query($conn, $sql);
                            }
                        } else {
                            header('location:index.php');
                 //           echo "date2";
                            exit;
                        }
                    } else {
                        header('location:index.php');
               //         echo "date1";
                        exit;
                    }
                } else {
                     header('location:index.php');
             //       echo "num2";
                    exit;
                }
            } else {
                header('location:index.php');
           //     echo "num1";
                exit;
            }
        } else {
            header('location:index.php');
         //   echo "phone";
            exit;
        }
    } else {
        header('location:index.php');
       // echo "name";
        exit;
    }
} else {
    header('location:index.php');
   // echo "không nhận submit";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require('head.html') ?>
<link rel="stylesheet" href="Css/style.bookroom.css">

<body>
    <?php require('header.html') ?>
    <div class="container bookroom" style="margin-top: 100px;">
        <h1 class="text-center text-info">
            Thank you for your booking
        </h1>
        <h3>
            Information you have registered :
        </h3>
        <div>
            <table class="table col-10 rounded-3 center-block table-striped table-borderless ">
                <tr>
                    <th class="col-5">Your Reservation code</th>
                    <td class="col-2">:</td>
                    <td class="col-5"><?php echo $idbookroomreserve ?></td>
                </tr>
                <tr>
                    <th class="col-5">Your full name</th>
                    <td class="col-2">:</td>
                    <td class="col-5"><?php echo $name ?></td>
                </tr>
                <tr>
                    <th class="col-5">Your Phone</th>
                    <td class="col-2">:</td>
                    <td class="col-5"><?php echo $phone ?></td>
                </tr>
                <tr>
                    <th class="col-5">Number of people</th>
                    <td class="col-2">:</td>
                    <td class="col-5"><?php echo $num ?></td>
                </tr>
                <tr>
                    <th class="col-5">Arrival day</th>
                    <td class="col-2">:</td>
                    <td class="col-5"><?php echo date_format($date, "d/m/Y") ?></td>
                </tr>
            </table>
        </div>
        <a href="index.php" class="btn">Back <i class="fas fa-reply"></i></a>
    </div>
    <?php require('footer.html') ?>
</body>

</html>