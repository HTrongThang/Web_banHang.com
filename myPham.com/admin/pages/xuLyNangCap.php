<?php
if (isset($_POST['activationValue'])) {
    $activationValue = $_POST['activationValue'];
    $id = $_POST['iduser'];

    $sql_update = "UPDATE `users` SET `userTypeID`='2' WHERE`userID`='$id'";
    $result_update = $connect->query($sql_update);
    if ($result_update) {
        echo "Bạn đã nâng cấp thành công tài khoản ";
    } else {
        echo "Bạn đã nâng cấp tài khoản không thành công. Vui lòng thử lại sau";
    }
}
