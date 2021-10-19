<?php
$num="10";
if (is_numeric($num)) {
    if (intval($num)> 0) {
        echo "ok";
    } else {
        echo "num2";
    }
} else {
    echo "num1";
}