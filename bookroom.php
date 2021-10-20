<!DOCTYPE html>
<html lang="en">
<?php require('head.html') ?>
<link rel="stylesheet" href="Css/style.bookroom.css">

<body>
    <?php require('header.html');
    require_once("config.php");
    $idbookroomreserve = "";
    $check = false;
    if (isset($_GET['id'])) {
        $idbookroomreserve = mysqli_real_escape_string($conn, $_GET['id']);
        if ($idbookroomreserve != "") {
            $sql = "SELECT * FROM dacs2.`bookroom.reserve` WHERE `idbookroom.reserve`='$idbookroomreserve'";
            $rs = mysqli_query($conn, $sql);
            if (mysqli_num_rows($rs) == 1) {
                $row = mysqli_fetch_array($rs);
                $idbookroomreserve = $row['idbookroom.reserve'];
                $name = $row['name'];
                $phone = $row['phone'];
                $num =   $row['num'];
                $date = date_create($row['date']);
                $regidate = date_create($row['regidate']);
                $idrooms = $row['idrooms'];
                $check = true;
            }
        }
    } else {
        header('location:index.php');
        exit;
    }
    if (!$check) {
    ?>
    <div class="container bookroom" style="margin-top: 100px;">
        
        <h1 class="text-center text-danger">
            Your reservation code does not exist
        </h1><br>
        <h3 style="margin-top: 5rem;">
            Your reservation code : <?php echo $idbookroomreserve  ?>
        </h3>
        <a href="index.php" class="btn" style="margin-top: 15rem;">Back <i class="fas fa-reply"></i></a>
    </div>
    <?php
        require('footer.html');
        echo "</body>
            </html>";
        exit;
    }
    ?>
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
                    <th class="col-5">Registration Time</th>
                    <td class="col-2">:</td>
                    <td class="col-5"><?php echo date_format($regidate, "H:i:s d/m/Y") ?></td>
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
                <tr>
                    <th class="col-5">Reservation Room Code</th>
                    <td class="col-2">:</td>
                    <td class="col-5"><?php echo $idrooms ?></td>
                </tr>
            </table>
        </div>
        <a href="index.php" class="btn">Back <i class="fas fa-reply"></i></a>
    </div>
    <?php require('footer.html') ?>
</body>

</html>