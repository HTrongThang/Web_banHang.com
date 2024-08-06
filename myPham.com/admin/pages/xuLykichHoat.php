<?php
if (isset($_POST['activationValue'])) {
    $activationValue = $_POST['activationValue'];
    $id = $_POST['iduser'];

    $sql_update = "UPDATE `users` SET `isSTatus_token`='$activationValue' WHERE`userID`='$id'";
    $result_update = $connect->query($sql_update);
    if ($result_update) {
        echo "Bạn đã kích hoạt tài khoản thành công";
    } else {
        echo "Bạn đã kích hoạt tài khoản không thành công. Vui lòng thử lại sau";
    }
}
