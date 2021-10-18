<?php
session_start();
if (isset($_GET['username'])) {
    # code...
}
$siteKey = '';
$secret = '';
$user = '';
$password = '';
if ($siteKey == '' && is_readable('config.php')) {
    $config = include 'config.php';
    $siteKey = $config['v2']['site'];
    $secret = $config['v2']['secret'];
}
require_once('vendor/google/recaptcha/src/autoload.php');
$recaptcha = new \ReCaptcha\ReCaptcha($secret);

$_SESSION['temppass'] = "";
$_SESSION['tempuser'] = "";
$noti = "";
$np = "";
$nu = "";
$nc = "";
if (!empty($_SESSION['username'])) {
    if (isset($_SESSION['password'])) {
        $usr = $_SESSION['username'];
        $hash = $_SESSION['password'];
        $sql = "SELECT * FROM account WHERE `username` ='$usr' AND `password`='$hash'";
        $query1 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query1) > 0) {
            if (isset($_SESSION['burl'])) {
                header('location:' . $_SESSION['burl']);
            }
            header('location:index.php');
        }
    }
}
if (isset($_POST["btn_login_submit"])) {
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
        $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
            ->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    }
    $user = mysqli_real_escape_string($conn, $_POST["input_user"]);
    $password = mysqli_real_escape_string($conn, $_POST["input_password"]);
    $a_check = ((isset($_POST['checkbox']) != 0) ? 1 : "");
    if ($user == "") {
        $_SESSION['tempuser'] = $_POST["input_user"];
        $noti = "Your username cannot be blank!";
        $nu = "error";
    } else {
        $_SESSION['tempuser'] = $_POST["input_user"];
        if ($password == "") {
            $noti = "Your password cannot be blank!";
            $np = "error";
        } else {
            $_SESSION['temppass'] = $_POST["input_password"];
            if (!$captcha) {
                $noti = "Please confirm captcha!";
                $nc = "error";
            } elseif ($resp->isSuccess()) {
                $sql = "SELECT * FROM `dacs2`.`account` WHERE `username` ='$user' or `email` ='$user' AND `password`='$password'";
                $rs = mysqli_query($conn, $sql);
                if (mysqli_num_rows($rs) == 0) {
                    $_SESSION['temppass'] = "";
                    $noti = "Username or password is incorrect!";
                    $snoti = "noti";
                } else {
                    $_SESSION['tempuser'] = "";
                    $_SESSION['temppasss'] = "";
                    $noti = "";
                    $snoti = "";
                    $_SESSION['username'] = $user;
                    if ($_SESSION['burl'] != "") {
                        header('location:' . $_SESSION['burl']);
                        exit;
                    }
                    header('Location: index.php');
                    exit;
                }
            } else {
                $errors = $resp->getErrorCodes();
                $noti = "Please check recaptcha again";
                $nc = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require('head.html') ?>

<body>
    <?php require('header.html') ?>
    <div class="login-form-container">
        <div id="khung_ngoai" class="khung_ngoai center-block">
            <div class="khung_sign">
                <div class="khung_singin">
                    <h4 class="text signin text-center">Sign in</h4>
                </div>
            </div>
            <form id="login_form" action="login.php" method="POST">
                <div class="khung_user <?php echo $nu ?>" id="khung_user">
                    <p id="label_user" class="label_pass float-left">Your user name <span>*</span></p>
                    <input id="input_user" name="input_user" class="input float-left " placeholder="User name or email" type="user" value="<?php if (isset($_SESSION['tempuser'])) {
                                                                                                                                                echo $_SESSION['tempuser'];
                                                                                                                                            }  ?>">
                </div>
                <div class="khung_pass <?php echo $np ?>" id="khung_pass">
                    <p id="label_pass" class="label_pass float-left">Your password <span>*</span></p>
                    <input id="input_pass" name="input_password" class="input" placeholder="******" type="password" value="<?php if (isset($_SESSION['temppass'])) {
                                                                                                                                echo $_SESSION['temppass'];
                                                                                                                            }  ?>">
                    <i class="fa fa-eye show-password" id="showpass"></i>
                </div>
                <div class="khung_forgot">
                    <a id="text_forgot" class="text forgot float-left" style="margin-right: 10px;" href="#">Forgot?</a>
                </div>
                <div class="khung_captcha <?php echo $nc ?>">
                    <div id="g-recaptcha" class="g-recaptcha " data-sitekey="<?php echo $siteKey ?>"></div>
                </div>
                <div class="khung_login">
                    <button type="submit" name="btn_login_submit" id="btn_login" class="btn_login">
                        Login
                    </button>
                </div>
            </form>
            <div id="khung_noti" class="khung_noti error">
                <p id="label_noti_error"><?php echo $noti ?></p>
            </div>
        </div>
    </div>
    <?php require('footer.html') ?>
</body>

</html>